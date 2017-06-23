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

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('city')) {
            $q->inCity($request->city);
        }

        if ($request->has('not_filled')) {
            $q->has('reception', false);
        }

        if ($request->has('without_specialities')) {
            $q->has('specialties', false);
        }

        if ($request->has('without_map')) {
            $q->has('map', false);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser();
        }

        if ($request->has('is_paid')) {
            $q->isPaid();
        }

        return $q;
    }
}
