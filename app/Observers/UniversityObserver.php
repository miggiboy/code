<?php

namespace App\Observers;

use App\Models\University\University;
use App\Support\Slug\UniqueSlug;

class UniversityObserver
{
    public function creating(University $university)
    {
        $university->slug = (new UniqueSlug)->create($university);
    }

    public function updating(University $university)
    {
        $university->slug = (new UniqueSlug)->create($university);
    }
}
