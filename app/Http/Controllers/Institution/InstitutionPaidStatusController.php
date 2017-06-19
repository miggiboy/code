<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\University\University;

class InstitutionPaidStatusController extends Controller
{
    /**
     * Toggles university paid status
     * @return Illuminate\Http\Response
     */
    public function update(University $university)
    {
        $institution->update('is_paid', ! $institution->is_paid);

        return back()->with('message', 'Статус вуза изменен');
    }
}
