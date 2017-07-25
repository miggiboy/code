<?php

namespace App\Modules\Search;

use App\Models\Profession\Profession;

class ProfessionSearch
{
    public static function applyFilters(\Illuminate\Http\Request $request)
    {
        $q = Profession::query();

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('category')) {
            $q->inCategory($request->category);
        }

        if ($request->has('has_description')) {
            $q->hasDescription($request->has_description);
        }

        if ($request->has('has_specialties')) {
            $q->has('specialties', (bool) $request->has_specialties);
        }

        if ($request->has('markers_of')) {
            $q->markedBy(request('markers_of'));
        }

        return $q;
    }
}
