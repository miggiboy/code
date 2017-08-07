<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;

class SpecialtyTypesController extends Controller
{
    public function update(Specialty $specialty)
    {
        if ($specialty->typeIs('qualification')) {
            $specialty->update([
                'type' => 'specialty',
                'parent_id' => null
            ]);

            return redirect()
                ->route('specialties.edit', ['college', $specialty])
                ->with([
                    'message' => 'Задайте направление специальности',
                    'notification' => 'warning',
                    'timeOut' => 90000
                ]);
        } else {
            $specialty->update([
                'type' => 'qualification'
            ]);

            return redirect()
                ->route('qualifications.edit', $specialty)
                ->with([
                    'message' => 'Задайте специальность квалификации',
                    'notification' => 'warning',
                    'timeOut' => 90000
                ]);
        }
    }
}
