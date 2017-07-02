<?php

namespace App\Traits\Marker;

use Auth;
use App\Models\User\User;

trait Markable
{
    public function scopeMarkedByCurrentUser($query, $marked = true)
    {
        return $query->has('markers', (bool) $marked);
    }

    public function isMarkedByCurrentUserWith($color)
    {
        return (bool) $this->markers
            ->where('user_id', Auth::user()->id)
            ->where('color', $color)
            ->count();
    }

    public function markersOf(User $user)
    {
        return $this->markers->where('user_id', $user->id);
    }

    public function getMarkedByCurrentUserAttribute()
    {
        if (! Auth::check()) {
            return false;
        }

        return $this->markers->where('user_id', Auth::user()->id)->count() === 1;
    }

    public function markers()
    {
        return $this->morphMany('\App\Models\User\Marker', 'markable');
    }
}
