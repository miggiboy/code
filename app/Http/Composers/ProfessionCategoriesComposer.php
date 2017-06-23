<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Profession\ProfessionCategories;

class ProfessionCategoriesComposer
{
    protected $categories;

    public function compose(View $view)
    {
        if (! $this->categories) {
            $this->categories = ProfessionCategories::all()->sortBy('title');
        }

        return $view->with('categories', $this->categories);
    }
}
