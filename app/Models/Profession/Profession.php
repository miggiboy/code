<?php

namespace App\Models\Profession;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;

class Profession extends Model
{
    use SoftDeletes;
    use Markable;

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

    protected $appends = ['markedByCurrentUser'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    public function specialities()
    {
        return $this->belongsToMany(\App\Models\Specialty\Speciality::class)
            ->select(['id', 'slug', 'title', 'code'])
            ->orderBy('title');
    }
}
