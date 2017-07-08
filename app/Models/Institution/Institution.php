<?php

namespace App\Models\Institution;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;

use App\Traits\Institution\{
    HasSpecialties,
    Searchable
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


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pin'];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['marked_by_current_user'];

    /**
     * Retrieves institutions of $type type
     *
     * @param  Builder $query
     * @param  string $institutionType
     * @return Builder
     */
    public function scopeOfType($query, $institutionType)
    {
        return $query->where('type', str_singular($institutionType));
    }

    public function getBaseUrl()
    {
        return parse_url($this->web_site_url)['host'] ?? $this->web_site_url;
    }

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

    protected function formatUrl($url)
    {
        if (! preg_match('/^http(s)?:\/\//', $url)) {
            return "http://{$url}";
        }

        return $url;
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
        return $this->hasOne(Map::class, 'mapable_id');
    }
}
