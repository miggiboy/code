<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Models\Specialty\Speciality;
use App\Http\Controllers\Controller;
use App\Models\University\University;

use App\Http\Requests\InstitutionSpecialtyRequest as SpecialtyRequest;

class UniversitySpecialtiesController extends Controller
{
    private $DBStudyForm;

    public function __construct()
    {
        $this->middleware('role:admin|moderator|developer');

        $this->DBStudyForm = Speciality::getDBStudyFormOrFail(request()->route('studyForm'));
    }

    public function index(University $university, $studyForm)
    {
        $university->load(['specialities' => function ($query) {
            $query->wherePivot('form', $this->DBStudyForm)->orderBy('title');
        }]);

        return view('universities.specialties.index', compact('university', 'studyForm'));
    }

    public function create(University $university, $studyForm)
    {
        $university->load(['specialities' => function ($query) {
            $query->wherePivot('form', $this->DBStudyForm);
        }]);

        $specialties = Speciality::ofUniversity()->orderBy('title')->get();

        return view('universities.specialties.create', compact('university', 'specialties', 'studyForm'));
    }

    public function store(University $university, $studyForm, Request $request)
    {
        $university->attachSpecialties($request, $this->DBStudyForm);

        session()->flash('message', 'Специальности прикреплены');

        if ($studyForm == 'full-time') {
            return redirect()->route('university.specialties.create', [$university, $studyForm]);
        }

        return redirect()->route('universities.show', $university->slug);
    }

    public function edit(University $university, $studyForm)
    {
        $university->load(['specialities' => function ($query) {
            $query->wherePivot('form', $this->DBStudyForm);
        }]);

        return view('universities.specialties.edit', compact('university', 'studyForm'));
    }

    public function update(University $university, $studyForm, SpecialtyRequest $request)
    {
        $specialtyDetails = collect($request->specialty_details);

        $specialtyDetails->each(function ($item, $key) use ($university) {
            $university->specialities()
                ->wherePivot('speciality_id', $key)
                ->wherePivot('form', $this->DBStudyForm)
                ->update([
                    'study_price'      => $item['price'],
                    'study_period'     => $item['study_period'],
                ]);
        });

        return redirect()
            ->route('university.specialties', [$university, $studyForm])
            ->with('message', 'Изменения внесены успешно');
    }

    public function destroy(University $university, $studyForm, Speciality $speciality)
    {
        $university->specialities()
            ->wherePivot('speciality_id', $speciality->id)
            ->wherePivot('form', $this->DBStudyForm)
            ->detach();

        return back()->with('message', 'Специальность откреплена.');
    }
}
