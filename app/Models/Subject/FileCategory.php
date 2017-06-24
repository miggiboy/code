<?php

namespace App\Models\Subject;

use App\Models\Model;

class FileCategory extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function subjects()
    {
        return $this->belongsToMany(\App\Subject::class, 'subject_file_category');
    }
}
