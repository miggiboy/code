<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;

use App\Models\Institution\{Institution, Map};

class InstitutionMapsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Institution $institution, Request $request)
    {
        $this->validate($request, [
            'source_code' => 'required'
        ]);

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
    public function update(Institution $institution, Request $request)
    {
        $this->validate($request, [
            'source_code' => 'required'
        ]);

        $institution->map()->update([
            'source_code' => $request->source_code
        ]);

        return back()->with('message', 'Карта обновлена!');
    }
}
