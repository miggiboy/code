<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Speciality;

class SpecialtyInstitutionsController extends Controller
{
    public function index(Request $request, Speciality $specialty)
    {
        $institutions = ($specialty->insitutionType() == 'universities')
            ? $specialty->universities
            : $specialty->colleges;

        return view('specialties.institutions.index', compact('specialty', 'institutions'));
    }
}
