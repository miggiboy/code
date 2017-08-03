<?php

namespace App\Observers;

use App\Models\Institution\Institution;
use App\Support\Slug\UniqueSlug;

class InstitutionObserver
{
    public function creating(Institution $institution)
    {
        $institution->slug = UniqueSlug::makeFor($institution);
    }

    public function updating(Institution $institution)
    {
        $institution->slug = UniqueSlug::makeFor($institution);
    }
}
