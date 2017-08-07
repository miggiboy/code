<?php

namespace App\Traits\Specialty;

use App\Models\Institution\Institution;

trait RelatesToInstitution
{
    public function scopeOf($query, $institutionType)
    {
        return
            $query->whereHas('direction', function ($q) use ($institutionType) {
                $q->of($institutionType);
            });
    }

    public function scopeAtForm($query, $studyForm)
    {
        return $query->where('form', $studyForm);
    }

    public function belongsToA($institutionType)
    {
        return strcmp(
            $this->institution_type, str_singular($institutionType)
        ) === 0;
    }

    /**
     * Gets institution type of specialty
     *
     * @return Builder
     */
    public function getInstitutionTypeAttribute()
    {
        return $this->direction->institution;
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class)->withPivot('study_price', 'study_period', 'form');
    }

    public function institutions_distinct()
    {
        return $this->belongsToMany(Institution::class)->groupBy('institution_id');
    }
}
