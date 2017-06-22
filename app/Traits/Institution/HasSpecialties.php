<?php

namespace App\Traits\Institution;

use Illuminate\Http\Request;

use App\Models\Specialty\Specialty;

trait HasSpecialties
{
    /**
     * Returns specialties of this insitution on full-time study-form
     *
     * @return \Illuminate\Support\Collection
     */
    public function atForm($studyForm)
    {
        return $this->specialties()->at($studyForm)->get();
    }

    /**
     * Determine if this insitution has specialty with given ID
     *
     * @param  integer $specialtyId
     * @param  integer $form
     * @return boolean
     */
    public function hasSpecialty($specialtyId, $studyForm)
    {
        return (bool) $this->specialties()
            ->wherePivot([
                'specialty_id' => $specialtyId,
                'form' => $studyForm
            ])
            ->count();
    }

    public function attachSpecialties(Request $request, $studyForm)
    {
        $specialtyIdOrTitleCode = collect($request->specialties);

        $specialtyIds = $specialtyIdOrTitleCode->map(function ($idOrNameCode, $key) {
            return (! is_numeric($idOrNameCode) ? Specialty::createFromString($idOrNameCode) : $idOrNameCode);
        });

        $specialtyIds->each(function ($item, $key) use ($studyForm) {
            if (! $this->hasSpecialty($item, $studyForm)) {
                $this->specialties()->attach($item, ['form' => $studyForm]);
            }
        });
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withPivot('study_price', 'study_period', 'form');
    }
}
