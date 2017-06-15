<?php

namespace App\Traits\Specialty;

trait HasReception
{
    public function insitutionType()
    {
        if ($this->isQualification()) {
            return 'colleges';
        }

        return ($this->direction->institution == '1')
            ? 'universities'
            : 'colleges';
    }

    public function getTranslatedInsitutionType()
    {
        return ($this->insitutionType() == 'universities')
             ? 'Университеты'
             : 'Колледжи';
    }

    public function getInstitutions()
    {
        $related = ($this->insitutionType() == 'universities')
            ? $this->universities()
            : $this->colleges();

        return $related->orderBy('title')->get();
    }

    /**
     * Returns all specialties which are being tought in universities
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUniversitySpecialities()
    {
        return static::ofUniversity()->orderBy('title')->get();
    }

    /**
     * Returns all specialties which are being tought in colleges
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCollegeSpecialities()
    {
        return static::ofCollege()->orderBy('title')->get();
    }

    public function scopeOfCollege($query)
    {
        return $query->whereHas('direction', function($q) {
            $q->where('institution', 0);
        });
    }

    public function scopeOfUniversity($query)
    {
        return $query->whereHas('direction', function ($q) {
            $q->where('institution', 1);
        });
    }

    public function scopeFullTime($query)
    {
        return $query->where('form', 1);
    }

    public function scopeExtramural($query)
    {
        return $query->where('form', 0);
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

    public function universities()
    {
        return $this->belongsToMany(\App\Models\University\University::class)
            ->where('type', 'university')
            ->withPivot('study_price', 'study_period', 'form');
    }

    public function colleges()
    {
        return $this->belongsToMany(\App\Models\College\College::class)
            ->where('type', 'college')
            ->withPivot('study_price', 'study_period', 'form');
    }
}
