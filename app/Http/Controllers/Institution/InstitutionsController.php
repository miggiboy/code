<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\City\City;
use App\Models\Institution\{
    Institution,
    ReceptionCommittee
};

use App\Http\Requests\University\{
    UpdateUniversityRequest,
    StoreUniversityRequest
};


class InstitutionsController extends Controller
{
    /**
     * Institution type
     * @var string
     */
    private $institutionType;

    public function __construct()
    {
        parent::__construct();

        $this->institutionType = str_singular(request()->route('institutionType'));
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = Institution::ofType($this->institutionType)
            ->with(['city', 'media', 'marks'])
            ->orderBy('title')
            ->paginate(15);

        return view('universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('universities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversityRequest $request)
    {
        $university = University::create(
            $request->except('reception', 'add_specialities')
        );

        $university->createOrUpdateReceptionIfProvided();

        session()->flash('message', 'ВУЗ добавлен успешно');

        if ($request->has('add_specialities')) {
            return redirect()->route('university.specialties.create', [$university, 'full-time']);
        }

        return redirect()->route('universities.show', $university->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show($type, Institution $university)
    {
        return view('universities.show', compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(University $university, UpdateUniversityRequest $request)
    {
        $university->update($request->except('reception', 'add_specialities'));

        $university->createOrUpdateReceptionIfProvided();

        session()->flash('message', 'ВУЗ обновлен успешно.');

        if ($request->has('add_specialities')) {
            return redirect()->route('university.specialties.create', [$university, 'full-time']);
        }

        return redirect()->route('universities.show', $university->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities')->with('message', 'Вуз удален.');
    }


    /**
     * Search methods
     */


    public function autocomplete(Request $request){

        $universities = University::select(
            'slug as url', "title as name", 'acronym', 'city_id'
            )
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $universities = $universities->each(function ($item, $key) {
            $item->url = env('APP_URL') . '/universities/' . $item->url;
            $item->acronym = ($item->acronym . ' ' ?: '') . City::find($item->city_id)->title;
        });

        return response()->json(['universities' => $universities]);
    }

    public function search(Request $request)
    {
        $q = University::query();

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

        $universities = $q->orderBy('title')->with(['city', 'media', 'marks'])->paginate(15);

        $request->flashOnly(['query', 'city']);

        return view('universities.index', compact('universities'));
    }
}
