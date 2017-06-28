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
     * Includes only articles which title
     * is like given query parameter
     *
     * @param  $query
     * @param  string $input
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $input)
    {
        return $query->where('title', 'like', "%{$input}%");
    }

    /**
     * Includes articles that belong to the given category
     *
     * @param  $query
     * @param  integer $category
     * @return \Illuminate\Support\Collection
     */
    public function scopeInCategory($query, $category)
    {
        return
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category);
            });
    }

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.' . 'articles') . $this->slug;
    }

    /**
     * Relations
     */

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category', 'article_id', 'category_id');
    }
}
