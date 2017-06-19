<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

use App\Models\Specialty\{
    Direction,
    Specialty
};

use App\Http\Requests\Specialty\{
    SpecialtyFormRequest
};

use App\Modules\Search\{
    SpecialtySearch
};

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $institutionType)
    {
        $specialties = SpecialtySearch::filter($request)
            ->orderBy('title')
            ->paginate(15);

        $directions = Direction::of($institutionType)
            ->orderBy('title')
            ->get();

        return view('specialties.index', compact('specialties', 'directions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($institutionType)
    {
        $subjects = Subject::all()->sortBy('title');

        $directions = Direction::of($institutionType)
            ->orderBy('title')
            ->get();

        return view('specialties.create', compact('subjects', 'directions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($institutionType, SpecialtyFormRequest $request)
    {
        if ($request->model_type == 'specialty') {
            if (! is_numeric($request->direction_id)) {
                $direction = Direction::create(['title' => $request->direction_id]);
            }
        }

        $specialty = Specialty::create([
            'title'                 => $request->title,
            'code'                  => $request->code,
            'description'           => $request->description,
            'short_description'     => $request->short_description,
            'type'                  => $request->model_type,
            'parent_id'             => ($request->model_type == 'specialty') ? null : $request->parent_id,
            'direction_id'          => ((isset($direction)) ? $direction->id : $request->direction_id),
        ]);

        if ($request->model_type === 'specialty') {
            if (isset($request->subject_1_id, $request->subject_2_id)) {
                $specialty->subjects()->attach($request->subject_1_id);
                $specialty->subjects()->attach($request->subject_2_id);
            }
        }

        return redirect()
            ->route('specialties.show', [$specialty, 'inst' => $request->inst])
            ->with('message', 'Успешно добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($institutionType, Specialty $specialty)
    {
        $specialty->load(['subjects']);
        return view('specialties.show', compact('specialty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($institutionType, Specialty $specialty)
    {
        $specialty->load(['subjects']);
        $subjects = Subject::all()->sortBy('title');
        $directions = Direction::all()->sortBy('title');

        return view('specialties.edit', compact('specialty', 'subjects', 'directions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($institutionType, Specialty $specialty, SpecialtyFormRequest $request)
    {
        $specialty->update(request([
            'title',
            'code',
            'description',
            'direction_id',
            'short_description',
        ]));

        $specialty->subjects()->detach();

        if (isset($request->subject_1_id, $request->subject_2_id)) {
            $specialty->subjects()->attach($request->subject_1_id);
            $specialty->subjects()->attach($request->subject_2_id);
        }

        return redirect()
            ->route('specialties.show', [$specialty, 'inst' => $request->inst])
            ->with('message', 'Специальность успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($institutionType, Specialty $specialty, Request $request)
    {
        $specialty->delete();

        return redirect()
            ->route('specialties', ['inst' => $request->inst])
            ->with('message', 'Специальность удалена');
    }

    /**
     * Search methods
     */

    public function autocomplete(Request $request){

        $specialties = Specialty::select('slug as url', 'title', 'code')
            ->like($request->input('query'))
            ->whereHas('direction', function ($query) use ($request) {
                $query->where('institution', $request->inst);
            })
            ->orderBy('title')
            ->get();

        $specialties = $specialties->each(function ($item, $key) use ($request) {
            $item->url = env('APP_URL') . '/specialties/' . $item->url . '?inst=' . $request->inst;
        });

        return response()->json(['specialties' => $specialties]);
    }

    public function searchCollegeSpecialties(Request $request)
    {
        $specialties = Specialty::select('id as value', 'title as name')
            ->like($request->input('query'))
            ->whereHas('direction', function ($query) use ($request) {
                $query->where('institution', $request->inst);
            })
            ->where('parent_id', null)
            ->get();

        return response()->json([
            'success' => true,
            'results' => $specialties
        ]);
    }
}
