<?php

namespace App;

use App\Model;

class Marker extends Model
{
    public function markable()
    {
        return $this->morphTo();
    }
}
