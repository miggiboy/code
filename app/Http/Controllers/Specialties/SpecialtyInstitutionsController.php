<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Speciality;

class SpecialtyInstitutionsController extends Controller
{
    public function index(Request $request, Speciality $specialty)
    {
        $specialty->load(
            [$specialty->insitutionType() . '.' . 'city']
        );

        return view('specialties.institutions.index', compact('specialty'));
    }
}
