<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Advertisement extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * Model is mass assignable
     * @var array
     */
    protected $guarded = [];
}
