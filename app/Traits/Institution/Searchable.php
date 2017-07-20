<?php

namespace App\Traits\Institution;

trait Searchable
{
    /**
     * Includes institutions which title or abbreviation
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
            ->orWhere('abbreviation', 'like', "%{$input}%");
    }

    /**
     * Includes institutions which belong to the city
     *
     * @param  $query
     * @param  string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeIn($query, $city)
    {
        return $query->where('city_id', get_id($city));
    }

    /**
     * Scope a query to only include paid institutions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  Boolean $isPaid
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPaid($query, $isPaid = true)
    {
        return $query->where('is_paid', $isPaid);
    }
}
