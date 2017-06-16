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
        $college->update(['is_paid' => !$college->is_paid]);

        return back()->with('message', 'Статус колледжа изменен');
    }
}
