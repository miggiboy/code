<?php

namespace App\Traits\Institution;

use Illuminate\Http\Request;

use App\Models\Specialty\Specialty;

trait HasSpecialties
{
    /**
     * Determine if this insitution has specialty with given ID
     *
     * @param  integer $specialtyID
     * @param  integer $studyForm
     * @return boolean
     */
    public function hasSpecialty($specialtyID, $studyForm)
    {
        return (bool) $this->specialties()
            ->wherePivot('specialty_id', $specialtyID)
            ->wherePivot('form', $studyForm)
            ->count();
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withPivot('study_price', 'study_period', 'form');
    }
}
