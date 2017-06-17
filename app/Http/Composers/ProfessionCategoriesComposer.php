<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Profession\ProfDirection;

class ProfessionCategoriesComposer
{
    protected $categories;

    public function compose(View $view)
    {
        if (! $this->categories) {
            $this->categories = ProfDirection::all()->sortBy('title');
        }

        return $view->with('categories', $this->categories);
    }
}
