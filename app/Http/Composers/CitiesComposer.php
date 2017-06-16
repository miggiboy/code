<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\City\City;

class CitiesComposer
{
    protected $cities;

    public function compose(View $view)
    {
        if (! $this->cities) {
            $this->cities = City::all()->sortBy('title');
        }

        return $view->with('cities', $this->cities);
    }
}
