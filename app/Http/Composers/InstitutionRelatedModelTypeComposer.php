<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class InstitutionRelatedModelTypeComposer
{
    protected $related;

    public function compose(View $view)
    {
        if (! $this->related) {

            $routeName = \Route::currentRouteName();

            $specialties = str_contains($routeName, 'specialties');

            $this->related = $specialties ? 'specialties' : 'qualifications';
        }

        return $view->with('related', $this->related);
    }
}
