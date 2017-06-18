<?php

namespace App\Models\Profession;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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



    protected $appends = ['markedByCurrentUser'];

    /*
    |--------------------------------------------------------------------------
    | Search scopes
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Filters out professions which title
     * is not like the given query parameter
     *
     * @param  $query
     * @param  string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $queryString)
    {
        $query->where('title', 'like', "%{$queryString}%");
    }

    /**
     * Filters out professions which don't belong to the given direction
     *
     * @param  $query
     * @param  integer $direction
     * @return \Illuminate\Support\Collection
     */
    public function scopeOfDirection($query, $direction)
    {
        $query->where('prof_direction_id', $direction);
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

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function profDirection()
    {
        return $this->belongsTo(ProfDirection::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(\App\Models\Specialty\Specialty::class)->select(['id', 'slug', 'title', 'code']);
    }
}
