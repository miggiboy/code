<?php

namespace App\Traits\Institution;

use Illuminate\Http\Request;

use App\Models\Specialty\Speciality;

trait HasSpecialties
{
    /**
     * Returns specialities of this insitution on full-time study-form
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFullTimeSpecialities()
    {
        return $this->specialities()->fullTime()
            ->orderBy('title')
            ->get();
    }

    /**
     * Returns specialities of this insitution on extramural study-form
     *
     * @return \Illuminate\Support\Collection
     */
    public function getExtramuralSpecialities()
    {
        return $this->specialities()->extramural()
            ->orderBy('title')
            ->get();
    }

    /**
     * Determine if this insitution has specialty with given ID
     *
     * @param  integer $specialityId
     * @param  integer $form
     * @return boolean
     */
    public function hasSpeciality($specialityId, $form)
    {
        return (bool) $this->specialities()
            ->wherePivot('speciality_id', $specialityId)
            ->wherePivot('form', $form)
            ->count();
    }

    public function attachSpecialties(Request $request, $studyForm)
    {
        $specialtyIdOrTitleCode = collect($request->specialties);

        $specialtyIds = $specialtyIdOrTitleCode->map(function ($idOrNameCode, $key) {
            return (! is_numeric($idOrNameCode) ? Speciality::createFromString($idOrNameCode) : $idOrNameCode);
        });

        $specialtyIds->each(function ($item, $key) use ($studyForm) {
            if (! $this->hasSpeciality($item, $studyForm)) {
                $this->specialities()->attach($item, ['form' => $studyForm]);
            }
        });
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class)->withPivot('study_price', 'study_period', 'form');
    }

    public function qualifications()
    {
        return $this->belongsToMany(Speciality::class)
            ->where('type', 'qualification')
            ->withPivot('study_price', 'study_period', 'form');
    }
}
