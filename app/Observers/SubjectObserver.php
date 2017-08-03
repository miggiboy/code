<?php

namespace App\Observers;

use App\Subject;
use App\Support\Slug\UniqueSlug;

class SubjectObserver
{
    public function creating(Subject $subject)
    {
        $subject->slug = UniqueSlug::makeFor($subject);
    }

    public function updating(Subject $subject)
    {
        $subject->slug = UniqueSlug::makeFor($subject);
    }
}
