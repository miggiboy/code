<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The model is mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    public function getRightAnswer()
    {
        return $this->answers()->where('is_right', true)->first();
    }

    // public function withShortAnswers($min = 8)
    // {
    //     return $query->whereHas('answers', function ($q) {
    //         $q->where('text')
    //     });
    // }

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
