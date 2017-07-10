<?php

namespace App\Observers;

use \App\Models\Specialty\Qualification;
use App\Support\Slug\UniqueSlug;

class QualificationObserver
{
    public function creating(Qualification $qualification)
    {
        $qualification->slug = (new UniqueSlug)->createFor($qualification);
    }

    public function updating(Qualification $qualification)
    {
        $qualification->slug = (new UniqueSlug)->createFor($qualification);
    }
}
