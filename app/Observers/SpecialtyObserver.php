<?php

namespace App\Observers;

use \App\Models\Specialty\Speciality;

class SpecialtyObserver
{
    public function creating(Speciality $specialty)
    {
        $specialty->slug = str_slug($specialty->title);
    }

    public function updating(Speciality $specialty)
    {
        $specialty->slug = str_slug($specialty->title);
    }
}
