<?php

namespace App\Models\Subject;

use App\Models\Model;

use Spatie\MediaLibrary\{
    HasMedia\HasMediaTrait
};

use Spatie\MediaLibrary\{
    HasMedia\Interfaces\HasMedia
};

class Subject extends Model implements HasMedia
{
    /**
     * Package traits
     */
    use HasMediaTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
