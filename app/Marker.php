<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $guarded = [];

    public function markable()
    {
        return $this->morphTo();
    }
}
