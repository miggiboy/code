<?php

namespace App\Observers;

use App\Models\Profession\Profession;
use App\Support\Slug\UniqueSlug;

class ProfessionObserver
{
    public function creating(Profession $profession)
    {
        $profession->slug = (new UniqueSlug)->createFor($profession);
    }

    public function updating(Profession $profession)
    {
        $profession->slug = (new UniqueSlug)->createFor($profession);
    }
}
