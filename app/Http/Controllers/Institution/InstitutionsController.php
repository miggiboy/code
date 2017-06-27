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

use Translator;


class InstitutionsController extends Controller
{
    /**
     * Existing institution types
     * @var array
     */
    protected static $institutionTypes = [
        'colleges',
        'universities',
    ];

    /**
     * Throw 404 exception if institution type is not in
     * self::$instituionTypes array
     */
    public function __construct()
    {
        parent::__construct();

        abort_unless(in_array(request()->route('institutionType'), self::$institutionTypes), 404);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $institutionType)
    {
        $institutions = InstitutionSearch::applyFilters($request)
            ->orderBy('title')
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
        return view('institutions.create', compact('institution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionFormRequest $request, $institutionType)
    {
        $institution = Institution::create(
            $request->except('reception')
        );

        if (array_filter($request->reception) != null) {
            $institution->reception()->create($request->reception);
        }

        return redirect()
            ->route('institutions.show', [$institutionType, $institution]);
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
    public function update(InstitutionFormRequest $request, $institutionType, Institution $institution)
    {
        $institution->update($request->except('reception'));

        $this->createOrUpdateReception($institution, $request->reception);

        return redirect()
            ->route('institutions.show', [$institutionType, $institution])
            ->withMessage('Информация обновлена');
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

    public function rtSearch(Request $request, $institutionType)
    {
        $institutions = Institution::select(
                'slug as url', "title", 'abbreviation as description', 'city_id', 'type'
            )
            ->ofType($institutionType)
            ->like($request->input('query'))
            ->orderBy('title')
            ->get();

        $institutions = $institutions->each(function ($item, $key) {
            $item->url = config('app.url')
                . '/institutions/'
                . str_plural($item->type)
                . '/'
                . $item->url;

            $item->description = ($item->description . ' ' ?: '') . City::find($item->city_id)->title; // smth wrong here!
        });

        return response()->json(['results' => $institutions], 200);
    }

    /**
     * Create or update reception if some information is provided
     * otherwise do not associate reception
     *
     * @param  Institution $institution
     * @param  Array       $reception
     * @return void
     */
    private function createOrUpdateReception(Institution $institution, $reception)
    {
        if (array_filter($reception) != null) {
            $institution->reception()
                ->updateOrCreate(
                    ['institution_id' => $institution->id],
                    $reception
                );
        }
    }
}
