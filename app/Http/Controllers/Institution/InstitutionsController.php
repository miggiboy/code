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


class InstitutionsController extends InstitutionsBaseController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($institutionType)
    {
        $institutions = Institution::ofType($institutionType)
            ->with(['city', 'media', 'marks'])
            ->orderBy('title')
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

    public function search(Request $request)
    {
        $q = Institution::query();

        $q->whereType($this->institutionType);

        if (request()->has('query')) {
            $q->like(request('query'));
        }

        if (request()->has('city')) {
            $q->inCity(request('city'));
        }

        if ($request->has('not_filled')) {
            $q->hasReception(false);
        }

        if ($request->has('without_specialities')) {
            $q->hasSpecialities(false);
        }

        if ($request->has('without_map')) {
            $q->hasMap(false);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser();
        }

        if ($request->has('is_paid')) {
            $q->isPaid();
        }

        $institutions = $q->orderBy('title')->with(['city', 'media', 'marks'])->paginate(15);

        $request->flashOnly(['query', 'city']);

        return view('institutions.index', compact('institutions'));
    }
}
