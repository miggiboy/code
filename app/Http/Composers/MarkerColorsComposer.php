<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class MarkerColorsComposer
{
    protected $markerColors;

    public function compose(View $view)
    {
        if (! $this->markerColors) {
            $this->markerColors = [
                'blue',
                'red',
                'orange',
                'green',
                'pink',
            ];
        }

        return $view->with('markerColors', $this->markerColors);
    }
}
