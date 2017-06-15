<?php

namespace App\Models\User\;

use App\Models\Model;

use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class News extends Model
{
    /**
     * Package traits
     */
    use LocalizedEloquentTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
