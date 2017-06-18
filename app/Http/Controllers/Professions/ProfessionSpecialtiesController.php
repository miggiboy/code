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
        $specialties = Specialty::orderBy('title')->get(['id', 'title', 'code']);

        return view('professions.specialties.create', compact('profession', 'specialties'));
    }

    public function store(Profession $profession, Request $request)
    {
        $profession->specialities()->syncWithoutDetaching($request->specialties);

        return redirect()
            ->route('professions.show', $profession)
            ->with('message', 'Специальности привязаны к профессии.');
    }

    public function destroy(Profession $profession, Specialty $specialty)
    {
        $profession->specialities()
            ->wherePivot('specialty_id', $specialty->id)
            ->detach();

        return redirect()
            ->route('professions.show', $profession)
            ->with('message', 'Специальность откреплена от профессии.');
    }
}
