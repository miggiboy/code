<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Article\ArticleCategories;

class ArticleCategoriesComposer
{
    protected $categories;

    public function compose(View $view)
    {
        if (! $this->categories) {
            $this->categories = ArticleCategories::all()->sortBy('title');
        }

        return $view->with('categories', $this->categories);
    }
}
