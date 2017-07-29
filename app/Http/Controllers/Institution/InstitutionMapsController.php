<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Institution\{
    Map,
    Institution
};

class InstitutionMapsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Institution $institution)
    {
        $this->validate($request, [
            'source_code' => 'required'
        ]);

        $institution->map()->create([
            'source_code' => $request->source_code
        ]);

        return back()->withMessage('Карта добалена');
    }

    public function destroy(Institution $institution)
    {
        $institution->map->delete();

        return back()->withMessage('Карта удалена');
    }
}
