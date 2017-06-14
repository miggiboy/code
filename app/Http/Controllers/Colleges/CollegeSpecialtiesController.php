<?php

namespace App\Http\Controllers\Colleges;

use Illuminate\Http\Request;
use App\Models\College\College;
use App\Models\Specialty\Speciality;
use App\Http\Controllers\Controller;

use App\Http\Requests\InstitutionSpecialtyRequest as SpecialtyRequest;

class CollegeSpecialtiesController extends Controller
{
    private $DBStudyForm;

    public function __construct()
    {
        $this->middleware('role:admin|moderator|developer');

        $this->DBStudyForm = Speciality::getDBStudyFormOrFail(
            request()->route('studyForm')
        );
    }

    public function index(College $college, $studyForm)
    {
        $college->load(['specialities' => function ($query) {
            request('category') == 'qualifications'
                ? $query->whereNotNull('parent_id')
                    ->wherePivot('form', $this->DBStudyForm)
                    ->orderBy('title')
                : $query
                    ->wherePivot('form', $this->DBStudyForm)
                    ->orderBy('title');
        }]);

        return view('colleges.specialties.index', compact('college', 'studyForm'));
    }

    public function create(College $college, $studyForm)
    {
        $college->load(['specialities' => function ($query) {
            request('category') == 'qualifications'
                ? $query->whereNotNull('parent_id')
                    ->wherePivot('form', $this->DBStudyForm)
                : $query
                    ->wherePivot('form', $this->DBStudyForm);
        }]);

        $specialties = (request('category') == 'qualifications')
            ? Speciality::isTypeQualification()
                ->orderBy('title')
                ->get()
            : Speciality::ofCollege()
                ->orderBy('title')
                ->get();

        return view('colleges.specialties.create', compact('college', 'specialties', 'studyForm'));
    }

    public function store(College $college, $studyForm, Request $request)
    {
        $college->attachSpecialties($request, $this->DBStudyForm);

        session()->flash('message', 'Специальности прикреплены');

        if ($studyForm == 'full-time') {
            return redirect()->route('college.specialties.create', [
                $college,
                'extramural',
                'category' => $request->category
            ]);
        }

        return redirect()->route('colleges.show', $college->slug);
    }

    public function edit(College $college, $studyForm)
    {
        $college->load(['specialities' => function ($query) {
            request('category') == 'qualifications'
                ? $query->whereNotNull('parent_id')
                    ->wherePivot('form', $this->DBStudyForm)
                : $query
                    ->wherePivot('form', $this->DBStudyForm);
        }]);

        return view('colleges.specialties.edit', compact('college', 'studyForm'));
    }

    public function update(College $college, $studyForm, SpecialtyRequest $request)
    {
        $specialtyDetails = collect($request->specialty_details);

        $specialtyDetails->each(function ($item, $key) use ($college) {
            $college->specialities()
                ->wherePivot('speciality_id', $key)
                ->wherePivot('form', $this->DBStudyForm)
                ->update([
                    'study_price'      => $item['price'],
                    'study_period'     => $item['study_period'],
                ]);
        });

        return redirect()
            ->route('colleges.show', $college->slug)
            ->with('message', 'Изменения внесены успешно');
    }

    public function destroy(College $college, $studyForm, Speciality $speciality)
    {
        $college->specialities()
            ->wherePivot('speciality_id', $speciality->id)
            ->wherePivot('form', $this->DBStudyForm)
            ->detach();

        return back()->with('message', 'Специальность откреплена.');
    }
}
