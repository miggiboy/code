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

    public function markersOf(User $user)
    {
        return $this->markers->where('user_id', $user->id);
    }

    public function markers()
    {
        return $this->morphMany('\App\Models\User\Marker', 'markable');
    }
}
