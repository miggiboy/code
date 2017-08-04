<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;

class SpecialtyInstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Specialty\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Specialty $specialty)
    {
        $specialty->load(['institutions' => function ($query) {
            $query->with('city')->orderBy('title');
        }]);

        return view('specialties.institutions.index', compact('specialty'));
    }
}
