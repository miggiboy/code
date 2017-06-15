<?php

namespace App\Models\Institution;

use App\Models\Model;

class Map extends Model
{
    public function mapable()
    {
        return $this->belongsTo(University::class, 'mapable_id');
    }
}
