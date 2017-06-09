<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->belongsToMany(\App\Subject::class, 'subject_file_category');
    }
}
