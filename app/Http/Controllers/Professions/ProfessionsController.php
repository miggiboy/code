<?php

namespace App\Http\Controllers\Professions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Profession\{Profession, ProfDirection};

use App\Http\Requests\Profession\{
    StoreProfessionRequest,
    UpdateProfessionRequest
};

class ProfessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professions.index', [
            'profDirections'    => ProfDirection::all()->sortBy('title'),
            'professions'       => Profession::orderBy('title')->with(['profDirection', 'marks'])->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professions.create', [
            'profession'     => new Profession,
            'profDirections' => ProfDirection::all()->sortBy('title'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessionRequest $request)
    {
        $profession = Profession::create($request->all());

        return redirect()
            ->route('profession.show', $profession)
            ->with('message', 'Профессия успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        return view('professions.show', compact('profession'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        $profDirections = ProfDirection::all()->sortBy('title');

        return view('professions.edit', compact('profession', 'profDirections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Profession $profession, UpdateProfessionRequest $request)
    {

        $profession->update($request->all());

        return redirect()
            ->route('profession.show', $profession)
            ->with('message', 'Профессия успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();

        return redirect()->route('professions')->with('message', 'Профессия удалена.');
    }

    public function autocomplete(Request $request){

        $professions = Profession::select('slug as url', "title as name")
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $professions = $professions->each(function ($item, $key) {
            $item->url = env('APP_URL') . '/professions/' . $item->url;
        });

        return response()->json(['professions' => $professions]);
    }

    public function search(Request $request)
    {
        $q = Profession::query();

        if (request()->has('query')) {
            $q->like(request('query'));
        }

        if (request()->has('direction')) {
            $q->ofDirection(request('direction'));
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser();
        }

        $professions = $q->orderBy('title')->with(['profDirection', 'marks'])->paginate(15);
        $profDirections = ProfDirection::all()->sortBy('title');

        $request->flashOnly(['query', 'direction']);

        return view('professions.index', compact('professions', 'profDirections'));
    }
}
