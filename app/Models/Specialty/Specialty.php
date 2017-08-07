<?php

namespace App\Models\Specialty;

use App\Models\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
     * Package traits
     */
    use Sluggable;

    /**
     * Custom traits
     */
    use Searchable;
    use Markable;
    use RelatesToInstitution;

    const STUDY_FORMS = [
        'full-time',
        'extramural',
        'distant',
    ];

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

    public function typeIs($type)
    {
        return strcmp($this->type, $type) === 0;
    }

    public function typeIsNot($type)
    {
        return ! $this->typeIs($type);
    }

    public static function studyForms()
    {
        return self::STUDY_FORMS;
    }

    public static function hasStudyForm($studyForm)
    {
        return in_array(str_singular($studyForm), self::STUDY_FORMS);
    }

    public static function doesntHaveStudyForm($studyForm)
    {
        return ! static::hasStudyForm($studyForm);
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

    public function otherSubject(Subject $subject)
    {
        return $this->subjects
            ->where('id', '!=', $subject->parent_id_or_id)
            ->first();
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

    public function setDirection()
    {
        if ($this->typeIsNot('qualification')) {
            throw new \Exception("Using 'setDirection' method is only allowed for qualifications");
        }

        $parent = $this->specialty;

        if ($parent) {
            $this->direction_id = $parent->direction_id;
        } else {
            $this->direction_id = SpecialtyDirection::getDefaultFor('colleges');
        }
    }

    /**
     * Builds model.show url at primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.url') . '/specialties/' . $this->slug;
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') .
            translate($this->type, 'i', 's', true) . ' ' . trim($this->title) . ' ' . trim($this->code) . ' Казахстан';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Relations
     */

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

    public function qualifications()
    {
        return $this->hasMany(Specialty::class, 'parent_id');
    }

    /**
     * Relation is specific to qualifications
     */
    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }
}
