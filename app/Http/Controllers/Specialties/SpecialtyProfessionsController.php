<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialty\Speciality;
use App\Models\Profession\Profession;

class SpecialtyProfessionsController extends Controller
{
    public function index(Speciality $specialty)
    {
        $professions = $specialty->professions()
            ->orderBy('title')
            ->get();

        return view('specialties.professions.index', compact('specialty', 'professions'));
    }

    public function create(Speciality $specialty)
    {
        $professions = Profession::orderBy('title')->get(['id', 'title']);
        return view('specialties.professions.create', compact('specialty', 'professions'));
    }

    public function store(Speciality $specialty, Request $request)
    {
        $specialty->professions()->syncWithoutDetaching($request->professions);

        return redirect()
            ->route('specialty.professions.index', $specialty)
            ->with('message', 'Профессии привязаны к специальности.');
    }

    public function destroy(Speciality $specialty, Profession $profession)
    {
        $specialty->professions()
            ->wherePivot('profession_id', $profession->id)
            ->detach();

        return redirect()
            ->route('specialty.professions.index', $specialty)
            ->with('message', 'Профессия откреплена от специальности.');
    }
}
