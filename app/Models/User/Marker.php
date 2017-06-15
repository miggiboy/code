<?php

namespace App\Models\User;

use App\Models\Model;

class Marker extends Model
{
    public function markable()
    {
        return $this->morphTo();
    }
}
