<?php

namespace App\Models\Institution;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;
use App\Traits\Institution\Searchable;
use App\Traits\Institution\{HasReception, HasSpecialties};

use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

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
    use HasReception;
    use HasSpecialties;

    protected $table = 'universities';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Instituttion representative pin
     */
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

        return static::formatUrl($value);
    }

    private function formatUrl($value)
    {
        if (! preg_match('/^http(s)?:\/\//', $value)) {
            return "http://{$value}";
        }

        return $value;
    }

    public function getBaseUrl()
    {
        return parse_url($this->web_site)['host'] ?? $this->web_site;
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') . trim($this->title) . ', ' . trim($this->city->title);
    }

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.' . 'institution') . $this->slug;
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
        return $this->hasOne(ReceptionCommittee::class);
    }

    public function map()
    {
        return $this->hasOne(Map::class, 'mapable_id');
    }
}
