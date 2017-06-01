<?php

namespace App\Traits\Institution;

trait Searchable
{
    /**
     * Includes institutions which belong these cities
     *
     * @param  array $cities
     * @return \Illuminate\Support\Collection
     */
    public function scopeInCities($query, $cities)
    {
        $query->whereHas('city', function($q) use ($cities) {
            $q->whereIn('id', $cities);
        });
    }

    /**
     * Includes institutions which title or acronym
     * is like the given query parameter
     *
     * @param  [type] $query
     * @param  string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $queryString)
    {
        $query
            ->where('title', 'like', "%{$queryString}%")
            ->orWhere('acronym', 'like', "%{$queryString}%");
    }

    /**
     * Includes institutions which belong to the city
     *
     * @param  [type] $query
     * @param  string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeInCity($query, $city)
    {
        $query->where('city_id', $city);
    }

    /**
     * Includes institutions which have or don't have related specialties
     *
     * @param  [type] $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasSpecialities($query, $has = true)
    {
        if ((bool) $has === true) {
            $query->has('specialities');
        } else {
            $query->doesntHave('specialities');
        }
    }

    /**
     * Includes institutions which have
     * or don't have related reception committee
     *
     * @param  [type] $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasReception($query, $has)
    {
        if ((bool) $has === true) {
            $query->has('reception');
        } else {
            $query->doesntHave('reception');
        }
    }

    /**
     * Includes institutions which have
     * or don't have related map
     *
     * @param  [type] $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasMap($query, $has)
    {
        if ((bool) $has === true) {
            $query->has('map');
        } else {
            $query->doesntHave('map');
        }
    }

    public function scopeIsPaid($query, $isPaid = true)
    {
        if ((bool) $isPaid === true) {
            $query->where('is_paid', 1);
        } else {
            $query->where('is_paid', '!=', 1);
        }
    }
}
