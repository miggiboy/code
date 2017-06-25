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

use \App\Models\Subject\Subject;


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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = ['marked_by_current_user'];

    /**
     * Retrieve only models which type is $type
     * @param  Builder $query
     * @param  string $type
     * @return Builder
     */
    public function scopeGetOnly($query, $type)
    {
        return $query->where('type', str_singular($type));
    }

    /**
     * Gets institution type of specialty
     * @return Builder
     */
    public function getBelongsToAttribute()
    {
        if (! $this->direction) {
            return null;
        }

        return $this->direction->institution;
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
     * Returns specialty name with specialty code if the code
     * is present in the DB
     * otherwise return only speciality name
     *
     * @return string
     */
    public function getNameWithCodeOrName() {

        if ($this->title && $this->code) {
            return "{$this->title} ({$this->code})";
        }

        return $this->title;
    }

    /**
     * Builds model.show url at primary app (vipusknik.kz)
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

    /**
     * Relations
     */

    public function parentSpecialty()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function direction()
    {
        return $this->belongsTo(SpecialtyDirection::class, 'direction_id');
    }

    public function professions()
    {
        return $this->belongsToMany(Profession::class)->select(['id', 'slug', 'title', 'category_id']);
    }
}
