<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Map;

class MapsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    private static $mapableClasses = [
        'college' => '\\App\\Models\\College\\College',
        'university' => '\\App\\Models\\University\\University',
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($institutionType, $id, Request $request)
    {
        $this->validate($request, [
            'source_code' => 'required'
        ]);

        $className = $this->isClassMapable($institutionType);

        $institution = $className::find($id);

        $institution->map()->create([
            'source_code' => $request->source_code
        ]);

        return back()->with('message', 'Карта добалена!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update($institutionType, $id, Request $request)
    {
        $this->validate($request, [
            'source_code' => 'required'
        ]);

        $className = $this->isClassMapable($institutionType);

        $institution = $className::find($id);

        $institution->map()->update([
            'source_code' => $request->source_code
        ]);

        return back()->with('message', 'Карта обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }

    private function isClassMapable($institutionType)
    {
        if (! class_exists($className = self::$mapableClasses[$institutionType])) {
            throw new \Exception('class ' . $className . ' not found!');
        }

        return $className;
    }
}
