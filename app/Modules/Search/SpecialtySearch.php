<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;
use App\Models\Specialty\Specialty;

class SpecialtySearch
{
    public static function applyFiltersTo($type, Request $request)
    {
        $q = Specialty::query();

        $q->getOnly($type)->of($request->route('institutionType') ?? 'college');

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('direction')) {
            $q->inDirection(request('direction'));
        }

        if ($request->has('has_description')) {
            $q->hasDescription($request->has_description);
        }

        if ($request->has('has_subjects')) {
            $q->has('subjects', (bool) $request->has_subjects);
        }

        if ($request->has('has_professions')) {
            $q->has('professions', (bool) $request->has_professions);
        }

        // No GUI for this option
        if ($request->has('has_institutions')) {
            $q->has('institutions', (bool) $request->has_institutions);
        }

        if ($request->has('markers_of')) {
            $q->markedBy(request('markers_of'));
        }

        // Qualification filters
        if ($request->has('has_specialty')) {
            $q->has('specialty', (bool) $request->has_specialty);
        }

        return $q;
    }
}
