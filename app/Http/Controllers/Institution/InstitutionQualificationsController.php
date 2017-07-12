<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;

use App\Http\Controllers\Institution\{
    InstitutionSpecialtiesController as Controller
};

use App\Models\Specialty\Specialty;
use App\Models\Institution\Institution;

use App\Http\Requests\{
    InstitutionSpecialtyRequest as SpecialtyRequest
};

class InstitutionQualificationsController extends Controller
{
    const RELATED = 'qualifications';
}
