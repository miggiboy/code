<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;
use App\Models\Institution\Institution;

class InstitutionSearch
{
    public static function applyFilters(Request $request)
    {
        $q = Institution::query();

        $q->ofType(
            $request->route('institutionType')
        );

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('city')) {
            $q->in($request->city);
        }

        if ($request->has('has_specialties')) {
            $q->has('specialties', (bool) $request->has_specialties);
        }

        if ($request->has('has_map')) {
            $q->has('map', (bool) $request->has_map);
        }

        if ($request->has('markers_of')) {
            $q->markedBy(request('markers_of'));
        }

        if ($request->has('is_paid')) {
            $q->isPaid($request->is_paid);
        }

        return $q;
    }
}
