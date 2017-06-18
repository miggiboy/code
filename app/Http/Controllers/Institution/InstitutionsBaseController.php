<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;

class InstitutionsBaseController extends Controller
{
    protected static $institutionTypes = [
        'colleges',
        'universities',
    ];

    public function __construct()
    {
        parent::__construct();

        if (! in_array(request()->route('institutionType'), self::$institutionTypes)) {
            abort(404);
        }
    }
}
