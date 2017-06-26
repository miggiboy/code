<?php

namespace App\Observers;

use App\Models\Institution\Institution;
use App\Support\Slug\UniqueSlug;

class InstitutionObserver
{
    public function creating(Institution $institution)
    {
        $institution->slug = (new UniqueSlug)->createFor($institution);
    }

    public function updating(Institution $institution)
    {
        $institution->slug = (new UniqueSlug)->createFor($institution);
    }
}
