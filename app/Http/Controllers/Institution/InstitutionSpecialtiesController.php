<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;
use App\Models\Institution\Institution;

use App\Http\Requests\{
    InstitutionSpecialtyRequest as SpecialtyRequest
};

class InstitutionSpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution, $studyForm)
    {
        $institution->load(['specialties' => function ($query) use ($studyForm) {
            $query->atForm($studyForm)->orderBy('title');
        }]);

        return view('institutions.specialties.index', compact('institution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Institution $institution, $studyForm)
    {
        $institution->load(['specialties' => function ($query) use ($studyForm) {
            $query->atForm($studyForm);
        }]);

        $specialties = Specialty::of($institution->type)
            ->orderBy('title')
            ->get();

        return view('institutions.specialties.create', compact('institution', 'specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Institution $institution, $studyForm)
    {
        $institution->attachSpecialties($request, $studyForm);

        session()->flash('message', 'Специальности прикреплены');

        if ($studyForm == 'full-time') {
            return redirect()->route('institutions.specialties.create', [$institution, 'extramural']);
        }

        return redirect()->route('institutions.show', [str_plural($institution->type), $institution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution, $studyForm)
    {
        $institution->load(['specialties' => function ($query) use ($studyForm) {
            $query->atForm($studyForm);
        }]);

        return view('institutions.specialties.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialtyRequest $request, Institution $institution, $studyForm)
    {
        $specialtyDetails = collect($request->specialty_details);

        $specialtyDetails->each(function ($item, $key) use ($institution, $studyForm) {
            $institution->specialties()
                ->wherePivot('specialty_id', $key)
                ->atForm($studyForm)
                ->update([
                    'study_price'      => $item['price'],
                    'study_period'     => $item['study_period'],
                ]);
        });

        return redirect()
            ->route('institutions.specialties.index', [$institution, $studyForm])
            ->with('message', 'Изменения внесены успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution, $studyForm, Specialty $specialty)
    {
        $institution->specialties()
            ->wherePivot('specialty_id', $specialty->id)
            ->wherePivot('form', $studyForm)
            ->detach();

        return back()->with('message', 'Специальность откреплена.');
    }
}
