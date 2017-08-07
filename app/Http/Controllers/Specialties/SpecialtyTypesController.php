<?php

namespace App\Http\Controllers\Specialties;

use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;

class SpecialtyTypesController extends Controller
{
    public function update(Specialty $specialty)
    {
        $specialty->update(['type' => 'qualification']);

        $specialty->setDirection()->save();

        return redirect()
            ->route('qualifications.edit', $specialty)
            ->with([
                'message' => 'Задайте специальность квалификации',
                'notification' => 'warning',
                'timeOut' => 90000
            ]);
    }
}
