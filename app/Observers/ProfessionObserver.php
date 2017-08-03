<?php

namespace App\Observers;

use App\Models\Profession\Profession;
use App\Support\Slug\UniqueSlug;

class ProfessionObserver
{
    public function creating(Profession $profession)
    {
        $profession->slug = UniqueSlug::makeFor($profession);
    }

    public function updating(Profession $profession)
    {
        $profession->slug = UniqueSlug::makeFor($profession);
    }
}
