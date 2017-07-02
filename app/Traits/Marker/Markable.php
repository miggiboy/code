<?php

namespace App\Traits\Marker;

use Auth;

trait Markable
{
    public function scopeMarkedByCurrentUser($query, $marked = true)
    {
        return $query->has('markers', (bool) $marked);
    }

    public function isMarked($color)
    {
        return (bool) $this->markers
            ->where('user_id', Auth::user()->id)
            ->where('color', $color)
            ->count();
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
