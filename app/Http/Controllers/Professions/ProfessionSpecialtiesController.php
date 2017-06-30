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
        $profession->load(['specialties']);

        $specialties = Specialty::getOnly('specialties')
            ->orderBy('title')
            ->get();

        return view('professions.specialties.create', compact('profession', 'specialties'));
    }

    public function store(Request $request, Profession $profession)
    {
        $profession->specialties()->sync(
            $request->specialties
        );

        return redirect()
            ->route('professions.show', $profession)
            ->withMessage('Список специальностей обновлен');
    }

    public function destroy(Profession $profession, Specialty $specialty)
    {
        $profession->specialties()->detach($specialty);

        return redirect()
            ->route('professions.show', $profession)
            ->withMessage('Специальность откреплена');
    }
}
