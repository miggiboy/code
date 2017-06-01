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
    public function scopeHasSubject($query, $subjectId)
    {
        $query->whereHas('subjects', function($q) use($subjectId) {
            $q->where('id', $subjectId);
        });
    }

    /**
     * Includes specialties which belong to this direction
     *
     * @param integer $directionId
     * @return \Illuminate\Support\Collection
     */
    public function scopeInDirection($query, $directionId)
    {
        $query->whereHas('direction', function($q) use($directionId) {
            $q->where('id', $directionId);
        });
    }

    /**
     * Includes specialties which belong to this institution
     *
     * @param integer $institution
     * @return \Illuminate\Support\Collection
     */
    public function scopeOfInstitution($query, $institution) 
    {
        $query->whereHas('direction', function($q) use($institution) {
            $q->where('institution', $institution);
        });
    }

    /**
     * Includes specialties which title or code is like query parameter
     *
     * @param string $queryString
     * @return \Illuminate\Support\Collection
     */
    public function scopeLike($query, $queryString)
    {
        $query
            ->where('title', 'like', "%{$queryString}%")
            ->orWhere('code', 'like', "%{$queryString}%");
    }

    /**
     * Includes specialties which have no reception committee
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasNoDescription($query) 
    {
        $query->where('description', null);
    }

    /**
     * Includes specialties which no have subjects
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasNoSubjects($query)
    {
        $query->doesntHave('subjects');
    }

    /**
     * Includes specialties which have no direction
     *
     * @return \Illuminate\Support\Collection
     */
    public function scopeHasNoDirection($query)
    {
        $query->whereHas('direction', function($q) {
            $q->where('title', 'Без направления');
        });
    }
}