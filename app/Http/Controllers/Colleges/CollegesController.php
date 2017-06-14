<?php

namespace App\Http\Controllers\Colleges;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\City;
use App\Models\College\{College, CollegeReception};

use App\Http\Requests\College\{StoreCollegeRequest, UpdateCollegeRequest};

class CollegesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all()->sortBy('title');
        $colleges = College::orderBy('title')->with(['city', 'media', 'marks'])->paginate(15);

        return view('colleges.index', compact('colleges', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all()->sortBy('title');

        return view('colleges.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCollegeRequest $request)
    {
        $college = College::create($request->except('reception', 'add_specialities'));

        $reception = array_filter(request('reception'));

        if ($reception) {
            $reception = CollegeReception::create([
                'college_id'        => $college->id,
                'info'              => request('reception.info'),
                'email'             => request('reception.email'),
                'address'           => request('reception.address'),
                'phone'             => request('reception.phone'),
                'phone_2'           => request('reception.phone_2'),
            ]);
        }

        session()->flash('message', 'Колледж добавлен.');

        if (request()->has('add_specialities')) {
            return redirect()
                ->route('college.specialties.create', [$college, 'full-time']);
        }

        return redirect()->route('colleges.show', $college->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $college = College::where('slug', $slug)->firstOrFail();

        return view('colleges.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        $cities = City::all()->sortBy('title');
        return view('colleges.edit', compact('college', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(College $college, UpdateCollegeRequest $request)
    {
        $college->update(
            $request->except('reception', 'add_specialities')
        );

        $reception = array_filter(
            request('reception')
        );

        if (request('reception')) {
            if (! $college->hasReception()) {
                CollegeReception::create(
                    ['college_id' => $college->id]
                );
            }

            $college->reception()->update([
                'college_id'        => $college->id,
                'info'              => request('reception.info'),
                'email'             => request('reception.email'),
                'address'           => request('reception.address'),
                'phone'             => request('reception.phone'),
                'phone_2'           => request('reception.phone_2'),
            ]);
        }

        session()->flash('message', 'Колледж обновлен успешно');

        if (request()->has('add_specialities')) {
            return redirect()
                ->route('college.specialties.create', [$college, 'full-time']);
        }

        return redirect()->route('colleges.show', $college->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(College $college)
    {
        $college->delete();

        return redirect()->route('colleges')->with('message', 'Колледж удален.');
    }


    /**
     * Search methods
     */

    public function autocomplete(Request $request){

        $colleges = College::select('slug as url', "title as name", 'acronym', 'city_id')
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $colleges = $colleges->each(function ($item, $key) {
            $item->url = env('APP_URL') . '/colleges/' . $item->url;
            $item->acronym = ($item->acronym . ' ' ?: '') . City::find($item->city_id)->title;
        });

        return response()->json(['colleges' => $colleges]);
    }

    public function search(Request $request)
    {
        $q = College::query();

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

        $cities = City::all()->sortBy('title');
        $colleges = $q->orderBy('title')->with(['city', 'media', 'marks'])->paginate(15);

        $request->flashOnly(['query', 'city']);

        return view('colleges.index', compact('colleges', 'cities'));
    }
}
