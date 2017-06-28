<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;

class SpecialtyProfessionsController extends Controller
{
    public function index(Specialty $specialty)
    {
        $professions = $specialty->professions()
            ->orderBy('title')
            ->get();

        return view('specialties.professions.index', compact('specialty', 'professions'));
    }

    public function create(Specialty $specialty)
    {
        $professions = Profession::orderBy('title')->get();

        return view('specialties.professions.create', compact('specialty', 'professions'));
    }

    public function store(Request $request, Specialty $specialty)
    {
        $specialty->professions()->sync($request->professions);

        return redirect()
            ->route('specialties.professions.index', $specialty)
            ->withMessage('Список профессий обновлен');
    }

    public function destroy(Specialty $specialty, Profession $profession)
    {
        $specialty->professions()->detach($profession);

        return redirect()
            ->route('specialties.professions.index', $specialty)
            ->withMessage('Профессия откреплена');
    }
}
