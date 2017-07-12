<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;
use App\Models\Institution\Institution;

use App\Http\Requests\{
    InstitutionSpecialtyRequest as SpecialtyRequest
};

use Translator;

class InstitutionSpecialtiesController extends Controller
{

    const RELATED = 'specialties';

    /**
     * Existing institution types
     *
     * @var array
     */
    const STUDY_FORMS = [
        'full-time',
        'extramural',
        'distant',
    ];

    /**
     * Throw 404 exception if study form is not in
     *
     * STUDY_FORMS array
     */
    public function __construct()
    {
        parent::__construct();

        abort_unless(
            in_array(request()->route('studyForm'), self::STUDY_FORMS), 404
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
                ->getOnly(static::RELATED)
                ->atForm($studyForm)
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
                ->getOnly(static::RELATED)
                ->atForm(request()->choose_from ?? $studyForm);
        }]);

        $specialties = Specialty::getOnLy(static::RELATED)
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
        $this->attachSpecialties(
            $institution,
            $request,
            $studyForm
        );

        $institution->specialties()->sync($request->specialties);

        return redirect()
            ->route('institutions.show', [str_plural($institution->type), $institution])
            ->withMessage(Translator::get(static::RELATED, 'i', 'p', true) . ' прикреплены');
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
                ->getOnly(static::RELATED)
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

        return back()->withMessage(Translator::get(static::RELATED, 'i', 's', true) . ' откреплена');
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

    public function attachSpecialties(Institution $institution, $request, $studyForm)
    {
        foreach ($request->specialties as $specialty) {
            if (! $institution->hasSpecialty($specialty, $studyForm)) {
                $institution->specialties()->attach($specialty, ['form' => $studyForm]);
            }
        }
    }
}
