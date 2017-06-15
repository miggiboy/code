<?php

namespace App\Observers;

use App\Models\Institution\Institution;
use App\Support\Slug\UniqueSlug;

class InstitutionObserver
{
    public function creating(Institution $university)
    {
        $university->slug = (new UniqueSlug)->create($university);
    }

    public function updating(Institution $university)
    {
        $university->slug = (new UniqueSlug)->create($university);
    }
}
