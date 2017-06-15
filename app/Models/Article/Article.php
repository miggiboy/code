<?php

namespace App\Models\Article;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
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

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function seeInPrimaryApp()
    {
        return config('primary_app.urls.' . 'article') . $this->slug;
    }

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
