<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;
use App\Models\Institution\Institution;

class InstitutionSearch
{
    public static function filter(Request $request)
    {
        $q = Institution::query();

        $q->ofType($request->route('institutionType'));

        if ($request->has('s.query')) {
            $q->like($request->s['query']);
        }

        if ($request->has('s.city')) {
            $q->inCity($request->s['city']);
        }

        if ($request->has('s.not_filled')) {
            $q->hasReception(false);
        }

        if ($request->has('s.without_specialities')) {
            $q->hasSpecialities(false);
        }

        if ($request->has('s.without_map')) {
            $q->hasMap(false);
        }

        if ($request->has('s.marked')) {
            $q->markedByCurrentUser();
        }

        if ($request->has('s.is_paid')) {
            $q->isPaid();
        }

        return $q;
    }
}
