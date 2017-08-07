<?php

namespace App\Observers;

use App\Models\Specialty\{
    Specialty,
    SpecialtyDirection
};

class QualificationObserver
{
    public function creating(Specialty $specialty)
    {
        if ($specialty->typeIs('qualification')) {
            $specialty->setDirection();
        }
    }

    public function updating(Specialty $specialty)
    {
        if ($specialty->typeIs('qualification')) {
            $specialty->setDirection();
        }
    }
}
