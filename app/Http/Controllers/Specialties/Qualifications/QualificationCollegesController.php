<?php

namespace App\Http\Controllers\Specialties\Qualifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Qualification;

class QualificationCollegesController extends Controller
{
    public function index(Qualification $qualification)
    {
        return view('qualifications.colleges.index', compact('qualification'));
    }
}
