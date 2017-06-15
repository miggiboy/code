<?php

namespace App\Models\File;

use App\Model;

class FileCategory extends Model
{
    public function subjects()
    {
        return $this->belongsToMany(\App\Subject::class, 'subject_file_category');
    }
}
