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
                'blue' => 'Синяя',
                'red' => 'Красная',
                'orange' => 'Оранжевая',
                'green' => 'Зеленая',
                'pink' => 'Розовая',
            ];
        }

        return $view->with('markerColors', $this->markerColors);
    }
}
