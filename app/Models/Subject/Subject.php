<?php

namespace App\Models\Subject;

use App\Models\Model;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Subject extends Model implements HasMedia
{
    /**
     * Package traits
     */
    use HasMediaTrait;

    /*
    |------------------------------------------
    | Relations with other tables
    |------------------------------------------
    |
    */

    public function specialities()
    {
        return $this->belongsToMany(\App\Models\Specialty\Speciality::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function fileCategories()
    {
        return $this->belongsToMany(\App\Models\File\FileCategory::class, 'subject_file_category');
    }
}
