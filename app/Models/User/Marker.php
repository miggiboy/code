<?php

namespace App\Models\User;

use App\Models\Model;

class Marker extends Model
{
    const COLORS = [
        'green',
        'blue',
        'red',
        'orange',
    ];

    public static function colorIsAllowed($color)
    {
        return in_array($color, self::COLORS);
    }

    public static function colorIsNotAllowed($color)
    {
        return ! static::colorIsAllowed($color);
    }

    public static function colors()
    {
        return self::COLORS;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markable()
    {
        return $this->morphTo();
    }
}
