<?php

namespace App\Traits\Specialty;

use App\Models\Institution\Institution;

trait RelatesToInstitution
{
    public function scopeOf($query, $institutionType)
    {
        return $query->whereHas('direction', function ($q) use ($institutionType) {
            $q->where('institution', $institutionType);
        });
    }

    public function scopeAt($query, $studyForm)
    {
        return $query->where('form', $studyForm);
    }

    public static function createFromString(String $titlenCode)
    {
        $specialty = new static;
        $specialty->setTitlenCodeFromString($titlenCode)->save();

        return $specialty->id;
    }

    public function setTitlenCodeFromString($string)
    {
        $this->title = static::explodeTitleCodeString($string)['title'];
        $this->code = static::explodeTitleCodeString($string)['code'];

        return $this;
    }

    /**
     * Split user provided string of specialityName_specialityCode format
     * into array with the corresponding elements
     *
     * @param  string $value
     * @return array
     */
    private static function explodeTitleCodeString($value)
    {
        $value = trim($value, '_');

        if (! stripos($value, '_')) {
            return ['title' => $value, 'code' => null];
        }

        return [
            'title' => explode('_', $value)[0],
            'code'  => explode('_', $value)[1],
        ];
    }

    public function institution()
    {
        return $this->belongsToMany(Institution::class)->withPivot('study_price', 'study_period', 'form');
    }
}
