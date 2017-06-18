<?php

namespace App\Modules\Search;

class ProfessionSearch
{
    public static function filter(\Illuminate\Http\Request $request)
    {
        $q = \App\Models\Profession\Profession::query();

        if ($request->has('s.query')) {
            $q->like($request->s['query']);
        }

        if ($request->has('s.direction')) {
            $q->ofDirection($request->s['direction']);
        }

        if ($request->has('s.marked')) {
            $q->markedByCurrentUser();
        }

        return $q;
    }
}
