<?php

namespace App\Http\Controllers\Professions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Profession\{
    Profession,
    ProfessionCategories
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
        $professions = ProfessionSearch::applyFilters($request)
            ->orderBy('title')
            ->with(['markers', 'category'])
            ->paginate(15);

        $categories = ProfessionCategories::all()->sortBy('title');

        return view('professions.index', compact('professions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProfessionCategories::all()->sortBy('title');

        return view('professions.create', compact('categories'));
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

        return redirect()->route('professions.show', $profession);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        $profession->load(['specialties.direction' => function ($query) {
            $query->orderBy('title');
        }]);

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
        $categories = ProfessionCategories::all()->sortBy('title');

        return view('professions.edit', compact('profession', 'categories'));
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
            ->route('professions.show', $profession)
            ->withMessage('Профессия обновлена');
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

        return redirect()->route('professions.index')->withMessage('Профессия удалена');
    }

    public function rtSearch(Request $request){

        $professions = Profession::select('slug as url', "title")
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $professions = $professions->each(function ($item, $key) {
            $item->url = config('app.url') . '/professions/' . $item->url;
        });

        return response()->json(['results' => $professions], 200);
    }
}
