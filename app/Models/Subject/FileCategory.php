<?php

namespace App\Models\Subject;

use App\Models\Model;

class FileCategory extends Model
{
    public function subjects()
    {
        return $this->belongsToMany(\App\Subject::class, 'subject_file_category');
    }
}
