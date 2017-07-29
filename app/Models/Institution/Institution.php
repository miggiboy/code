<?php

namespace App\Models\Institution;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;

use App\Traits\Institution\{
    HasSpecialties,
    Searchable,
    HasType,
    ComposesUrls
};

use Spatie\MediaLibrary\HasMedia\{
    Interfaces\HasMediaConversions
};

use Spatie\MediaLibrary\{
    HasMedia\HasMediaTrait
};

use Illuminate\Http\Request;

class Institution extends Model implements HasMediaConversions
{
    /**
     * Laravel traits
     */
    use SoftDeletes;

    /**
     * Package traits
     */
    use HasMediaTrait;

    /**
     * Custom traits
     */
    use Markable;
    use Searchable;
    use HasType;
    use ComposesUrls;
    use HasSpecialties;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_dormitory'     => 'boolean',
        'has_military_dep'  => 'boolean',
        'is_paid'           => 'boolean',
    ];

    const TYPES = [
        'college',
        'university',
    ];

    /**
     * Always returns web_site_url attribute with http(s)
     *
     * @param  String $value
     * @return String
     */
    public function getWebSiteUrlAttribute($value)
    {
        return $value ? $this->formatUrl($value) : null;
    }

    /**
     * Checks if this institution has reception committee
     *
     * @return boolean
     */
    public function hasReception()
    {
        return (bool) $this->reception()->count();
    }

    /**
     * Checks if this institution has map
     *
     * @return boolean
     */
    public function hasMap()
    {
        return (bool) $this->map()->count();
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    public function togglePaidStatus()
    {
        $this->is_paid = ! $this->is_paid;

        return $this;
    }

    /**
     * Relations
     */

    public function city()
    {
        return $this->belongsTo(\App\Models\City\City::class);
    }

    public function reception()
    {
        return $this->hasOne(ReceptionCommittee::class);
    }

    public function map()
    {
        return $this->hasOne(Map::class);
    }
}
