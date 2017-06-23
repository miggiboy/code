<?php

namespace App\Traits\Specialty;

trait Searchable
{
    /**
     * Includes specialties which have the subject
     * as one of it's subjects
     *
     * @param integer $subjectId
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasSubject($query, $subject)
    {
        return $query
            ->whereHas('subjects', function($q) use($subject) {
                $q->where('id', $subject);
            });
    }

    /**
     * Includes specialties which belong to this direction
     *
     * @param integer $direction
     * @return \Illuminate\Support\Collection
     */
    public function scopeInDirection($query, $direction)
    {
        return $query
            ->whereHas('direction', function($q) use($direction) {
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
     * Includes specialties which have no reception committee
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasDescription($query, $has = true)
    {
        return $query->where('description', ($has ? '!=' : '='), null);
    }

    /**
     * Includes specialties which no have subjects
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasSubjects($query, $has = true)
    {
        return $has
            ? $query->has('subjects')
            : $query->doesntHave('subjects');
    }

    /**
     * Includes specialties which have no direction
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasNoDirection($query)
    {
        return $query
            ->whereHas('direction', function($q) {
                $q->where('title', 'Без направления');
            });
    }
}
