<?php

namespace App\Observers;

use App\Models\College\College;
use App\Support\Slug\UniqueSlug;

class CollegeObserver
{
    public function creating(College $college)
    {
        $college->slug = (new UniqueSlug)->create($college);
    }

    public function updating(College $college)
    {
        $college->slug = (new UniqueSlug)->create($college);
    }
}
