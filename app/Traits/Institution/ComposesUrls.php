<?php

namespace App\Traits\Institution;

trait ComposesUrls
{
    public function getBaseUrl()
    {
        $exceptions = ['vk.com'];

        if (str_contains($this->web_site_url, $exceptions)) {
            return $this->web_site_url;
        }

        return parse_url($this->web_site_url)['host'] ?? $this->web_site_url;
    }

    /**
     * Google search
     */

    public function googleSearchUrl()
    {
        return config('google.search.url') . trim($this->title) . ', ' . trim($this->city->title);
    }

    /**
     * Google maps url
     */

    public function googleMapsUrl()
    {
        return config('google.maps.url') . trim($this->title);
    }

    /**
     * Redirects to primary app (vipusknik.kz)
     */

    public function urlAtPrimaryApp()
    {
        return config('primary_app.urls.institutions') . str_plural($this->type) . '/' . $this->slug;
    }

    protected function formatUrl($url)
    {
        if (! preg_match('/^http(s)?:\/\//', $url)) {
            return "http://{$url}";
        }

        return $url;
    }
}
