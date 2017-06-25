<?php

namespace App\Traits\Marker;

use Auth;

trait Markable
{
    public function scopeMarkedByCurrentUser($query, $marked = true)
    {
        return $query->has('marks', (bool) $marked);
    }

    public function getMarkedByCurrentUserAttribute()
    {
        if (! Auth::check()) {
            return false;
        }

        return $this->marks->where('user_id', Auth::user()->id)->count() === 1;
    }

    public function marks()
    {
        return $this->morphMany('\App\Models\User\Marker', 'markable');
    }
}
