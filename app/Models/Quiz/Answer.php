<?php

namespace App\Models\Quiz;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
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

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
