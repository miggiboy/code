<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Institution\Institution;

class InstitutionPaidStatusController extends Controller
{
    /**
     * Toggles institution paid status
     *
     * @return Illuminate\Http\Response
     */
    public function update(Institution $institution)
    {
        dd($insittuion);
        $institution->togglePaidStatus()->save();

        return back()->withMessage('Статус изменен');
    }
}
