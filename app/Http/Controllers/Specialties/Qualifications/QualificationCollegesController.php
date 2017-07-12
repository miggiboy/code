<?php

namespace App\Http\Controllers\Specialties\Qualifications;

use Illuminate\Http\Request;

use App\Http\Controllers\Specialties\{
    SpecialtyInstitutionsController as Controller
};

use App\Models\Specialty\Specialty;

class QualificationCollegesController extends Controller
{
    public function index(Request $request, Specialty $qualification)
    {
        return parent::index($request, $qualification);
    }
}
