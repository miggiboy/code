<?php

namespace App;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    /**
     * Laravel traits
     */
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getRightAnswer()
    {
        return $this->answers()->where('is_right', true)->first();
    }

    /**
     * Relations
     */

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
