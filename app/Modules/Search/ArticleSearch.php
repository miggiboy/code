<?php

namespace App\Modules\Search;

use App\Models\Article\Article;

class ArticleSearch
{
    public static function applyFilters(\Illuminate\Http\Request $request)
    {
        $q = Article::query();

        if ($request->has('query')) {
            $q->like(request('query'));
        }

        if ($request->has('category')) {
            $q->inCategory($request->category);
        }

        if ($request->has('markers_of')) {
            $q->markedBy(request('markers_of'));
        }

        return $q;
    }
}
