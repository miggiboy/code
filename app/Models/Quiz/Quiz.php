<?php

namespace App\Models\Quiz;

use App\Models\Model;

class Quiz extends Model
{
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Relations
     */

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject\Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
