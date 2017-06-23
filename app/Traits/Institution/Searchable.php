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

    public function scopeIsPaid($query, $isPaid = true)
    {
        return $query->where('is_paid', $isPaid);
    }
}
