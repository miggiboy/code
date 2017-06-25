<?php

namespace App\Observers;

use \App\Models\Specialty\Specialty;
use App\Support\Slug\UniqueSlug;

class SpecialtyObserver
{
    public function creating(Specialty $specialty)
    {
        $specialty->slug = (new UniqueSlug)->createFor($specialty);
    }

    public function updating(Specialty $specialty)
    {
        $specialty->slug = (new UniqueSlug)->createFor($specialty);
    }
}
