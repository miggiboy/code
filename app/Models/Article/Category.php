<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The model is mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function articles()
    {
        return $this->belongsTomany(Article::class);
    }
}
