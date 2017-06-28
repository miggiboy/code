<?php

namespace App\Models\Profession;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Specialty\Specialty;

use App\Traits\Marker\Markable;

class Profession extends Model
{
    /**
     * Laravel traits
     */
    use SoftDeletes;

    /**
     * Custom traits
     */
    use Markable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = ['marked_by_current_user'];

    /**
     * Filters out professions which title
     * is not like the given query parameter
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
     * Includes professions which (don't) have description
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasDescription($query, $has = true)
    {
        return $query->where('full_description', ((bool) $has ? '!=' : '='), null);
    }

    /**
     * Filters out professions which don't belong to the given direction
     *
     * @param  $query
     * @param  integer $direction
     * @return \Illuminate\Support\Collection
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category_id', $category);
    }

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.' . 'professions') . $this->slug;
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') . 'Профессия ' . trim($this->title);
    }

    public function category()
    {
        return $this->belongsTo(ProfessionCategories::class, 'category_id');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->select(['id', 'slug', 'title', 'code']);
    }
}
