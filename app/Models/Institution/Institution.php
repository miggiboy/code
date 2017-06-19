<?php

namespace App\Models\Institution;

use App\Models\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Marker\Markable;
use App\Traits\Institution\Searchable;

use App\Traits\Institution\{
    HasReception,
    HasSpecialties
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_paid'           => 'boolean',
        'has_dormitory'     => 'boolean',
        'has_military_dep'  => 'boolean',
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
     * @param  Builder $query
     * @param  string $institutionType
     * @return Builder
     */
    public function scopeOfType($query, $institutionType)
    {
        return $query->where('type', str_singular($institutionType));
    }

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

    public function getBaseUrl()
    {
        return parse_url($this->web_site)['host'] ?? $this->web_site;
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

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    private static function formatUrl($value)
    {
        if (! preg_match('/^http(s)?:\/\//', $value)) {
            return "http://{$value}";
        }

        return $value;
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
