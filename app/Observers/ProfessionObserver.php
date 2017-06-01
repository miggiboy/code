<?php

namespace App\Observers;

use App\Models\Profession\Profession;

class ProfessionObserver
{
    public function creating(Profession $profession)
    {
        $profession->slug = str_slug($profession->title);
    }

    public function updating(Profession $profession)
    {
        $profession->slug = str_slug($profession->title);
    }
}
