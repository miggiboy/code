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
    const SPECIALTY_TYPE = 'specialties';

    /**
     * Throw 404 exception if study form is not in
     *
     * STUDY_FORMS array
     */
    public function __construct()
    {
        parent::__construct();

        abort_if(
            Specialty::doesntHaveStudyForm(request()->route('studyForm')), 404
        );
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution, $studyForm)
    {
        $institution->load(['specialties' => function ($query) use ($studyForm) {
            $query
                ->getOnly(static::SPECIALTY_TYPE)
                ->atForm($studyForm)
                ->with('direction')
                ->orderBy('title');
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
            $query
                ->getOnly(static::SPECIALTY_TYPE)
                ->atForm(request()->choose_from ?? $studyForm);
        }]);

        $specialties = Specialty::getOnLy(static::SPECIALTY_TYPE)
            ->of($institution->type)
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
        $specialties = $this->getSpecialtiesByTypeFor($institution);

        $syncData = $this->prepareSyncData(
            $request,
            $studyForm
        );

        $institution->specialties()
            ->wherePivotIn('specialty_id', $specialties)
            ->wherePivot('form', $studyForm)
            ->sync($syncData);

        return redirect()
            ->route('institutions.show', [str_plural($institution->type), $institution])
            ->withMessage(
                'Список ' . translate(static::SPECIALTY_TYPE, 'r', 'p') . ' обновлен'
            );
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
            $query
                ->getOnly(static::SPECIALTY_TYPE)
                ->atForm($studyForm)
                ->orderBy('title');
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
        $this->updateSpecialties(
            $institution,
            $request->specialty_details,
            $studyForm
        );

        return redirect()
            ->route('institutions.specialties.index', [$institution, $studyForm])
            ->withMessage('Информация обновлена');
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

        return back()->withMessage(
            translate(static::SPECIALTY_TYPE, 'i', 's', true) . ' откреплена'
        );
    }

    private function getSpecialtiesByTypeFor($institution) {
        return $institution->specialties()->getOnly(static::SPECIALTY_TYPE)->pluck('id');
    }

    private function updateSpecialties(Institution $institution, $specialtyDetails, $studyForm)
    {
        $specialtyDetails = collect($specialtyDetails);

        foreach ($specialtyDetails as $specialtyID => $data) {
            $institution->specialties()
                ->wherePivot('specialty_id', $specialtyID)
                ->atForm($studyForm)
                ->update([
                    'study_price'      => $data['price'],
                    'study_period'     => $data['study_period'],
                ]);
        }
    }

    public function prepareSyncData($request, $studyForm)
    {
        $specialties = $request->specialties ?? [];

        $studyForms = array_fill(0, count($specialties), ['form' => $studyForm]);

        return array_combine($specialties, $studyForms);
    }
}
