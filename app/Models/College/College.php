<?php

namespace App\Models\College;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Institution\{Searchable, HasMap};
use App\Traits\Institution\{HasReception, HasSpecialties};

use App\Traits\Marker\Markable;

use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class College extends Model implements HasMediaConversions
{
    use Markable;
    use HasMap;
    use Searchable;
    use SoftDeletes;
    use HasReception;
    use HasSpecialties;
    use HasMediaTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The model is mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    protected $hidden = ['pin'];

    protected $appends = ['markedByCurrentUser'];

    /*
    |--------------------------------------------------------------------------
    | Attribute accessors
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Always returns web_site attribute with http(s)://
     *
     * @param  string $value
     * @return string
     */
    public function getWebSiteAttribute($value)
    {
        if (! $value) {
            return null;
        }

        if (! preg_match('/^http(s)?:\/\//', $value)) {
            return "http://{$value}";
        }

        return $value;
    }

    public function getBaseUrl()
    {
        return parse_url($this->web_site)['host'] ?? null;
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function city()
    {
        return $this->belongsTo(\App\City::class);
    }

    public function reception()
    {
        return $this->hasOne(CollegeReception::class);
    }
}
