<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\University\University;

class UniversityPaidStatusController extends Controller
{
    /**
     * Toggles university paid status
     * @return Illuminate\Http\Response
     */
    public function toggle(University $university)
    {
        if ($university->is_paid) {
            $university->is_paid = null;
        } else {
            $university->is_paid = true;
        }

        $university->save();

        return back()->with('message', 'Статус вуза изменен');
    }
}
