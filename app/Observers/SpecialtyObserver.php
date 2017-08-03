<?php

namespace App\Observers;

use \App\Models\Specialty\Specialty;
use App\Support\Slug\UniqueSlug;

class SpecialtyObserver
{
    public function creating(Specialty $specialty)
    {
        $specialty->slug = UniqueSlug::makeFor($specialty);
    }

    public function updating(Specialty $specialty)
    {
        $specialty->slug = UniqueSlug::makeFor($specialty);
    }
}
