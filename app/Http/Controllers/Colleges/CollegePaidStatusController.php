<?php

namespace App\Http\Controllers\Colleges;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\College\College;

class CollegePaidStatusController extends Controller
{
    /**
     * Toggles university paid status
     * @return Illuminate\Http\Response
     */
    public function toggle(College $college)
    {
        if ($college->is_paid) {
            $college->is_paid = null;
        } else {
            $college->is_paid = true;
        }

        $college->save();

        return back()->with('message', 'Статус колледжа изменен');
    }
}
