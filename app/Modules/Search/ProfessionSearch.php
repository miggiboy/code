<?php

namespace App\Modules\Search;

class ProfessionSearch
{
    public static function filter(\Illuminate\Http\Request $request)
    {
        $q = \App\Models\Profession\Profession::query();

        if ($request->has('query')) {
            $q->like($request->query);
        }

        if ($request->has('direction')) {
            $q->ofDirection($request->direction);
        }

        if ($request->has('marked')) {
            $q->markedByCurrentUser();
        }

        return $q;
    }
}
