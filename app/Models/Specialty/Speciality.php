<?php

namespace App\Models\Specialty;

use App\Traits\Specialty\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;

class Speciality extends Model
{
    use SoftDeletes, Searchable, Markable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The model is mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = [
        'markedByCurrentUser'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    */

   public function hasValidParent()
   {
       return ! Speciality::find($this->parent_id) == null;
   }

   public function scopeIsTypeQualification($query)
   {
       return $query->where('type', 'qualification');
   }

   public function scopeIsSpecialty($query)
   {
        return $query->where('type', 'specialty');
   }

   public function isQualification()
   {
       return $this->type == 'qualification';
   }

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

    public static function getDBStudyFormOrFail($key)
    {
        $studyForms = [
            'extramural' => 0,
            'full-time'  => 1,
        ];

        if (! isset($studyForms[$key])) {
            abort(404);
        }

        return $studyForms[$key];
    }

    /**
     * Check if the specialty has any subjects
     *
     * @return boolean
     */
    public function hasSubjects()
    {
        return (bool) $this->subjects()->count();
    }

    /**
     * Returns specialty name with specialty code if the last
     * is present in the DB
     * otherwise return only speciality name
     *
     * @return string
     */
    public function getNameWithCodeOrName() {

        if ($this->title && $this->code) {
            return "{$this->title} ({$this->code})";
        }

        if ($this->title) {
            return $this->title;
        }

        return null;
    }

    /**
     * Returns all specialties which are being tought in universities
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUniversitySpecialities()
    {
        return static::ofUniversity()->orderBy('title')
            ->get();
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

    /**
     * Checks if this specialty is already linked to the profession
     *
     * @param  integer $profession
     * @return boolean
     */
    public function hasSpeciality($specialityId, $form = 1)
    {
        return (bool) $this->professions()
            ->wherePivot('profession_id', $profession)
            ->count();
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

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function qualifications()
    {
        return $this->hasMany(Speciality::class, 'parent_id');
    }

    public function parentSpecialty()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(\App\Subject::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function universities()
    {
        return $this->belongsToMany(\App\Models\University\University::class)
            ->withPivot('study_price', 'study_period', 'form');
    }

    public function colleges()
    {
        return $this->belongsToMany(\App\Models\College\College::class)
            ->withPivot('study_price', 'study_period', 'form');
    }

    public function professions()
    {
        return $this->belongsToMany(\App\Models\Profession\Profession::class)
            ->select(['id', 'slug', 'title', 'prof_direction_id']);
    }
}
