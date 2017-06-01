<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class News extends Model
{
    use LocalizedEloquentTrait;
    
    /**
     * The model is mass assignable
     * 
     * @var array
     */
    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
