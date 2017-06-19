<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\City\City;

class InstitutionTypeComposer
{
    protected $institutionType;

    public function compose(View $view)
    {
        if (! $this->institutionType) {
            $this->institutionType = \Request::route('institutionType');
        }

        return $view->with('institutionType', $this->institutionType);
    }
}
