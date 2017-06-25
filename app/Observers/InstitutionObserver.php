<?php

namespace App\Observers;

use App\Models\Institution\Institution;
use App\Support\Slug\UniqueSlug;

class InstitutionObserver
{
    public function creating(Institution $institution)
    {
        $institution->slug = (new UniqueSlug)->createFor($institution);

        if(isset($institution->web_site)) {
            $institution->web_site = static::formatUrl($institution->web_site);
        }
    }

    public function updating(Institution $institution)
    {
        $institution->slug = (new UniqueSlug)->createFor($institution);

        if(isset($institution->web_site)) {
            $institution->web_site = static::formatUrl($institution->web_site);
        }
    }

    private static function formatUrl($url)
    {
        if (! preg_match('/^http(s)?:\/\//', $url)) {
            return "http://{$url}";
        }

        return $url;
    }
}
