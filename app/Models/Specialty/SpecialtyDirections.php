<?php

namespace App\Models\Specialty;

use App\Models\Model;

class SpecialtyDirections extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scopeOf($query, $institutionType)
    {
        return $query->where('institution', $institutionType);
    }
}
