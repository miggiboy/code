<?php

namespace App;

use App\Model;

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
