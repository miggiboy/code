<?php

namespace App\Models\Specialty;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;
use App\Traits\Specialty\Searchable;
use App\Traits\Specialty\RelatesToInstitution;


class Speciality extends Model
{
    /**
     * Laravel traits
     */
    use SoftDeletes;

    /**
     * Custom traits
     */
    use Searchable;
    use Markable;
    use RelatesToInstitution;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $appends = ['markedByCurrentUser'];

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

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.' . 'specialty') . $this->slug;
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') . 'Специальность ' . trim($this->title) . ' ' . trim($this->code) . ' Казахстан';
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
        return $this->belongsToMany(\App\Models\Subject\Subject::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function professions()
    {
        return $this->belongsToMany(\App\Models\Profession\Profession::class)
            ->select(['id', 'slug', 'title', 'prof_direction_id']);
    }
}
