<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;
use App\Models\Specialty\Specialty;

class SpecialtySearch
{
    public static function applyFilters(Request $request)
    {
        $q = Specialty::query();

        $q->getOnly('specialties')->of($request->route('institutionType'));

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('direction')) {
            $q->inDirection(request('direction'));
        }

        if ($request->has('has_description')) {
            $q->hasDescription($request->has_description);
        }

        if ($request->has('has_direction')) {
            $q->hasDirection($request->has_direction);
        }

        if ($request->has('has_subjects')) {
            $q->has('subjects', (bool) $request->has_subjects);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser($request->marked);
        }

        return $q;
    }
}
