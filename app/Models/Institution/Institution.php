<?php

namespace App\Models\Institution;

use App\Models\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
     * Package traits
     */
    use HasMediaTrait;
    use Sluggable;

    /**
     * Custom traits
     */
    use Markable;
    use Searchable;
    use HasType;
    use ComposesUrls;
    use HasSpecialties;

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

    public function togglePaidStatus()
    {
        $this->is_paid = ! $this->is_paid;

        return $this;
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

    public function logo()
    {
        return $this->getMedia('logo')->first();
    }

    public function hasLogo()
    {
        return $this->logo() !== null;
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
