<?php

namespace App\Observers;

use App\Models\University\University;

class UniversityObserver
{
    public function creating(University $university)
    {
        $university->slug = str_slug($university->title);
    }

    public function updating(University $university)
    {
        $university->slug = str_slug($university->title);
    }
}
