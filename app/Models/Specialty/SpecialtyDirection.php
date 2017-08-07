<?php

namespace App\Models\Specialty;

use App\Models\Model;
use App\Models\Institution\Institution;

use App\Exceptions\NoDefaultDirectionException;
use Exception;

class SpecialtyDirection extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_default'    => 'boolean',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Scope a query to only include directions
     * of a specific institution type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param String $institutionType
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOf($query, $institutionType)
    {
        return $query->where('institution', str_singular($institutionType));
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Fetches default direction of a particular institution type
     * Default direction's title has to be 'Без направления'
     *
     * @param  String $institutionType
     * @return int    direction id
     */
    public static function getDefaultFor($institutionType)
    {
        if (Institution::doesntHaveType($institutionType)) {
            throw new Exception("'{$institutionType}' is not a valid institution type.");
        }

        $default = static::default()->of($institutionType)->first();

        if ($default === null) {
            throw new NoDefaultDirectionException($institutionType);
        }

        return $default->id;
    }
}
