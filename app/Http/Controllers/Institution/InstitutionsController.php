<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\City\City;
use App\Models\Institution\{
    Institution,
    ReceptionCommittee
};

use App\Http\Requests\Institution\{
    InstitutionFormRequest
};

use App\Modules\Search\{
    InstitutionSearch
};


class InstitutionsController extends InstitutionsBaseController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($institutionType, Request $request)
    {
        $institutions = $request->has('s')
            ? InstitutionSearch::filter($request)
            : Institution::ofType($institutionType);

        $institutions = $institutions->orderBy('title')
            ->with(['city', 'media', 'marks'])
            ->paginate(15);

        return view('institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionFormRequest $request, $institutionType)
    {
        $institution = Institution::create($request->except('reception', 'add_specialities'));

        $institution->createOrUpdateReceptionIfProvided();

        session()->flash('message', 'Учебное заведение добавлено успешно');

        if ($request->has('add_specialities')) {
            return redirect()->route('institutions.specialties.create', [$institution, 'full-time']);
        }

        return redirect()->route('institutions.show', [$institutionType, $institution]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show($institutionType, Institution $institution)
    {
        return view('institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit($institutionType, Institution $institution)
    {
        return view('institutions.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update($institutionType, Institution $institution, InstitutionFormRequest $request)
    {
        $institution->update($request->except('reception', 'add_specialities'));

        $institution->createOrUpdateReceptionIfProvided();

        session()->flash('message', 'Учебное заведение обновлено успешно');

        if ($request->has('add_specialities')) {
            return redirect()->route('institutions.specialties.create', [$institutionType, $institution, 'full-time']);
        }

        return redirect()->route('institutions.show', [$institutionType, $institution]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy($institutionType, Institution $institution)
    {
        $institution->delete();

        return redirect()->route('institutions.index', $institutionType)->with('message', 'Учебное заведение удалено');
    }

    /**
     * Search methods
     */


    public function autocomplete(Request $request){

        $institutions = Institution::select(
                'slug as url', "title as name", 'acronym', 'city_id'
            )
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $institutions = $institutions->each(function ($item, $key) {
            $item->url = env('APP_URL') . '/institutions/' . str_plural($this->institutionType) . $item->url;
            $item->acronym = ($item->acronym . ' ' ?: '') . City::find($item->city_id)->title;
        });

        return response()->json(['institutions' => $institutions]);
    }
}
