<?php

namespace App\Models\Subject;

use App\Models\Model;

use Spatie\MediaLibrary\{
    HasMedia\HasMediaTrait
};

use Spatie\MediaLibrary\{
    HasMedia\Interfaces\HasMedia
};

use Cviebrock\EloquentSluggable\Sluggable;

class Subject extends Model implements HasMedia
{
    /**
     * Package traits
     */
    use HasMediaTrait;
    use Sluggable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_profile'     => 'boolean',
    ];

    public function getParentIdOrIdAttribute()
    {
        return $this->parent_id ?: $this->id;
    }

    public function getSpecialties()
    {
        $subject = $this;

        if ($this->parent_id) {
            $subject = static::find($this->parent_id);
        }

        return $subject->specialties();
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

    public function specialties()
    {
        return $this->belongsToMany(\App\Models\Specialty\Specialty::class);
    }

    public function quizzes()
    {
        return $this->hasMany(\App\Models\Quiz\Quiz::class);
    }

    public function fileCategories()
    {
        return $this->belongsToMany(FileCategory::class, 'subject_file_category');
    }
}
