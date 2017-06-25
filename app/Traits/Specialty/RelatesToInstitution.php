<?php

namespace App\Traits\Specialty;

use App\Models\Institution\Institution;

trait RelatesToInstitution
{
    public function scopeOf($query, $institutionType)
    {
        return $query
            ->whereHas('direction', function ($q) use ($institutionType) {
                $q->of($institutionType);
            });
    }

    public function scopeAtForm($query, $studyForm)
    {
        return $query->where('form', $studyForm);
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class)->withPivot('study_price', 'study_period', 'form');
    }
}
