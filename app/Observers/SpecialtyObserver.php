<?php

namespace App\Observers;

use \App\Models\Specialty\Speciality;
use App\Support\Slug\UniqueSlug;

class SpecialtyObserver
{
    public function creating(Speciality $specialty)
    {
        $specialty->slug = (new UniqueSlug)->create($specialty);
    }

    public function updating(Speciality $specialty)
    {
        $specialty->slug = (new UniqueSlug)->create($specialty);
    }
}
