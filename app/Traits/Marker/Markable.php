<?php

namespace App\Traits\Marker;

use App\Models\User\User;

trait Markable
{
    public function isMarkedByCurrentUserWith($color)
    {
        return (bool) $this->markers
            ->where('user_id', \Auth::user()->id)
            ->where('color', $color)
            ->count();
    }

    public function markersOf($user)
    {
        return $this->markers->where('user_id', get_id($user));
    }

    public function scopeMarkedBy($query, $user)
    {
        return
            $query->whereHas('markers', function ($q) use ($user) {
                $q->where('user_id', get_id($user));
            });
    }

    public function markers()
    {
        return $this->morphMany('\App\Models\User\Marker', 'markable');
    }
}
