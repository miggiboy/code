<?php

namespace App\Models\Specialty;

use App\Models\Model;

class SpecialtyDirections extends Model
{
    public function scopeOf($query, $institutionType)
    {
        return $query->where('institution', $institutionType);
    }
}
