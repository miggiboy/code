<?php

namespace App\Traits\Specialty;

trait Searchable
{
    /**
     * Includes specialties which belong to this direction
     *
     * @param integer $direction
     * @return \Illuminate\Support\Collection
     */
    public function scopeInDirection($query, $direction)
    {
        return $query
            ->whereHas('direction', function($q) use ($direction) {
                $q->where('id', $direction);
            });
    }

    /**
     * Includes specialties which title or code is like query parameter
     *
     * @param string $input
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $input)
    {
        return $query
            ->where('title', 'like', "%{$input}%")
            ->orWhere('code', 'like', "%{$input}%");
    }

    /**
     * Includes specialties which (don't) have description
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasDescription($query, $has = true)
    {
        return $query->where('description', ((bool) $has ? '!=' : '='), null);
    }

    /**
     * Includes specialties which have no direction
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasDirection($query, $has = true)
    {
        return $query
            ->whereHas('direction', function($q) use ($has) {
                $q->where('title', ((bool) $has ? '!=' : '='), 'Без направления');
            });
    }
}
