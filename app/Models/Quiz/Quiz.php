<?php

namespace App\Models\Quiz;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


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
