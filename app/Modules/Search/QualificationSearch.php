<?php

namespace App\Modules\Search;

use Illuminate\Http\Request;

use App\Models\Specialty\Qualification;

class QualificationSearch
{
    public static function applyFilters(Request $request)
    {
        $q = Qualification::query();

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('has_description')) {
            $q->hasDescription($request->has_description);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser($request->marked);
        }

        return $q;
    }
}
