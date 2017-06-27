<?php

namespace App\Http\Controllers\Professions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;

class ProfessionSpecialtiesController extends Controller
{
    public function create(Profession $profession)
    {
        $specialties = Specialty::orderBy('title')->get();

        return view('professions.specialties.create', compact('profession', 'specialties'));
    }

    public function store(Request $request, Profession $profession)
    {
        $profession->specialties()->syncWithoutDetaching($request->specialties);

        return redirect()
            ->route('professions.show', $profession)
            ->withMessage('Специальности прикреплены');
    }

    public function destroy(Profession $profession, Specialty $specialty)
    {
        $profession->specialties()
            ->wherePivot('specialty_id', $specialty->id)
            ->detach();

        return redirect()
            ->route('professions.show', $profession)
            ->withMessage('Специальность откреплена');
    }
}
