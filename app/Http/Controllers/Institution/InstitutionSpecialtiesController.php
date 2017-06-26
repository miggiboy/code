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
     * Existing institution types
     * @var array
     */
    protected static $studyForms = [
        'full-time',
        'extramural',
    ];

    /**
     * Throw 404 exception if study form is not in
     * self::$studyForms array
     */
    public function __construct()
    {
        parent::__construct();

        abort_unless(in_array(request()->route('studyForm'), self::$studyForms), 404);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution, $studyForm)
    {
        $institution->load(['specialties' => function ($query) use ($studyForm) {
            $query
                ->with(['direction'])
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
            $query->atForm(request()->choose_from ?? $studyForm);
        }]);

        $specialties = Specialty::getOnLy('specialties')
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
        $institution->attachSpecialties($request, $studyForm);

        if ($studyForm == 'full-time') {
            return redirect()->route('institutions.specialties.create', [$institution, 'extramural']);
        }

        return redirect()
            ->route('institutions.show', [str_plural($institution->type), $institution])
            ->withMessage('Специальности прикреплены');
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
            $query->atForm($studyForm)->orderBy('title');
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
}
