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
        $institution->update('is_paid', ! $institution->is_paid);

        return back()->withMessage('Статус изменен');
    }
}
