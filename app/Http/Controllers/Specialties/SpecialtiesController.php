<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

use App\Models\Specialty\{
    SpecialtyDirections,
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
     * Existing institution types
     * @var array
     */
    protected static $institutionTypes = [
        'college',
        'university',
    ];

    /**
     * Throw 404 exception if institution type is not in
     * self::$instituionTypes array
     */
    public function __construct()
    {
        parent::__construct();

        abort_if (! in_array(\Request::route('institutionType'), self::$institutionTypes), 404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $institutionType)
    {
        $specialties = SpecialtySearch::filter($request)
            ->with(['direction', 'marks'])
            ->orderBy('title')
            ->paginate(15);

        $directions = SpecialtyDirections::of($institutionType)
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

        $directions = SpecialtyDirections::of($institutionType)
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
    public function store(SpecialtyFormRequest $request, $institutionType)
    {
        if ($request->model_type == 'specialty') {
            if (! is_numeric($request->direction_id)) {
                $direction = SpecialtyDirections::create(['title' => $request->direction_id]);
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
            ->route('specialties.show', [$institutionType, $specialty])
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

        $directions = SpecialtyDirections::of($institutionType)
            ->orderBy('title')
            ->get();

        return view('specialties.edit', compact('specialty', 'subjects', 'directions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialtyFormRequest $request, $institutionType, Specialty $specialty)
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
            ->route('specialties.show', [$institutionType, $specialty])
            ->with('message', 'Специальность успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $institutionType, Specialty $specialty)
    {
        $specialty->delete();

        return redirect()
            ->route('specialties.index', $institutionType)
            ->with('message', 'Специальность удалена');
    }

    /**
     * Search methods
     */

    public function rtSearch(Request $request, $institutionType)
    {
        $specialties = Specialty::select('slug as url', 'title', 'code as description')
            ->of($institutionType)
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $specialties = $specialties->each(function ($item, $key) use ($request, $institutionType) {
            $item->url = config('app.url') . "/{$institutionType}-specialties/" . $item->url;
        });

        return response()->json(['results' => $specialties]);
    }
}
