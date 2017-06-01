<?php

namespace App\Observers;

use App\Models\College\College;

class CollegeObserver
{
    public function creating(College $college)
    {
        $college->slug = str_slug($college->title);
    }

    public function updating(College $college)
    {
        $college->slug = str_slug($college->title);
    }
}
