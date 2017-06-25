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

    /**
     * Attaches a set of specialties at a given study form
     *
     * @param  Illuminate\Http\Request $request
     * @param  String  $studyForm
     * @return void
     */
    public function attachSpecialties(Request $request, $studyForm)
    {
        foreach ($request->specialties as $specialtyID) {
            if (! $this->hasSpecialty($specialtyID, $studyForm)) {
                $this->specialties()->attach($specialtyID, ['form' => $studyForm]);
            }
        }
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withPivot('study_price', 'study_period', 'form');
    }
}
