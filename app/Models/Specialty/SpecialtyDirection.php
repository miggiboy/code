<?php

namespace App\Models\Specialty;

use App\Models\Model;

class SpecialtyDirection extends Model
{
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
}
