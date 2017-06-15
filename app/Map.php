<?php

namespace App;

use App\Model;

class Map extends Model
{
    public function mapable()
    {
        return $this->belongsTo(App\Models\University\University::class, 'mapable_id');
    }
}
