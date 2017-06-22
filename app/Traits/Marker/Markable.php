<?php

namespace App\Traits\Marker;

trait Markable
{
    public function scopeMarkedByCurrentUser($query, $marked = true)
    {
        if ($marked) {
            return $query->has('marks');
        }

        return $query->doesntHave('marks');
    }

    public function getMarkedByCurrentUserAttribute()
    {
        if (! \Auth::check()) {
            return false;
        }

        return $this->marks->where('user_id', \Auth::user()->id)->count() === 1;
    }

    public function marks()
    {
        return $this->morphMany('\App\Models\User\Marker', 'markable');
    }
}
