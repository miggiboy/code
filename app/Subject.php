<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Subject extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title'];

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
    | Relations with other tables
    |--------------------------------------------------------------------------
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
