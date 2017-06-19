<?php

namespace App\Models\Specialty;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;
use App\Traits\Specialty\Searchable;
use App\Traits\Specialty\{
    RelatesToInstitution
};

use App\Models\Profession\Profession;


class Specialty extends Model
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

    protected $table = 'specialities';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $appends = ['marked_by_current_user'];

    public function scopeGetOnly($query, $type)
    {
        return $query->where('type', str_singular($type));
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    */

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
        return $this->belongsToMany(Profession::class)->select(['id', 'slug', 'title', 'prof_direction_id']);
    }
}
