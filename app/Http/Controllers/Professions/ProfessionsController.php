<?php

namespace App\Http\Controllers\Professions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Profession\{
    Profession,
    ProfDirection
};

use App\Http\Requests\Profession\{
    ProfessionFormRequest
};

use App\Modules\Search\{
    ProfessionSearch
};

class ProfessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $professions = ProfessionSearch::filter($request)
            ->orderBy('title')
            ->with(['profDirection', 'marks'])
            ->paginate(15);

        return view('professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profession = new Profession;

        return view('professions.create', compact('profession'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionFormRequest $request)
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
        return view('professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionFormRequest $request, Profession $profession)
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

    public function rtSearch(Request $request){

        $professions = Profession::select('slug as url', "title")
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $professions = $professions->each(function ($item, $key) {
            $item->url = config('app.url') . '/professions/' . $item->url;
        });

        return response()->json(['results' => $professions]);
    }
}
