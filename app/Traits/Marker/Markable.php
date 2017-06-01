<?php

namespace App\Traits\Marker;

use Auth;

trait Markable
{
    public function scopeMarkedByCurrentUser($query, $marked = true)
    {
        if ((bool) $marked === true) {
            $query->has('marks');
        } else {
            $query->doesntHave('marks');
        }
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
        return $this->morphMany('\App\Marker', 'markable');
    }
}
