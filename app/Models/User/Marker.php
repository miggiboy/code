<?php

namespace App\Models\User;

use App\Models\Model;

class Marker extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markable()
    {
        return $this->morphTo();
    }
}
