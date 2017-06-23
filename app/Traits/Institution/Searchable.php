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
        return $query
            ->whereHas('city', function($q) use ($cities) {
                $q->whereIn('id', $cities);
            });
    }

    /**
     * Includes institutions which title or acronym
     * is like the given query parameter
     *
     * @param  $query
     * @param  string $input
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $input)
    {
        return $query
            ->where('title', 'like', "%{$input}%")
            ->orWhere('acronym', 'like', "%{$input}%");
    }

    /**
     * Includes institutions which belong to the city
     *
     * @param  $query
     * @param  string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeInCity($query, $city)
    {
        return $query->where('city_id', $city);
    }

    /**
     * Includes institutions which have or don't have related specialties
     *
     * @param  $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasSpecialities($query, $has = true)
    {
        return $has
            ? $query->has('specialties')
            : $query->doesntHave('specialties');
    }

    /**
     * Includes institutions which have
     * or don't have related reception committee
     *
     * @param  $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasReception($query, $has = true)
    {
        return $has
            ? $query->has('reception')
            : $query->doesntHave('reception');
    }

    /**
     * Includes institutions which have
     * or don't have related map
     *
     * @param  $query
     * @param  boolean $has
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasMap($query, $has = true)
    {
        return $has
            ? $query->has('map')
            : $query->doesntHave('map');
    }

    public function scopeIsPaid($query, $isPaid = true)
    {
        return $query->where('is_paid', $isPaid);
    }
}
