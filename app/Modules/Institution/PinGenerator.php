<?php

namespace App\Modules\Institution;

use App\Models\College\College;
use App\Models\University\University;

class PinGenerator
{
    public static function generateUniquePin()
    {
        $exists = true;
        $existingPins = static::getExistingPins();

        while($exists) {
            $pin = static::getRandomPin();
            $exists = array_has($existingPins, $pin);
        }

        return $pin;
    }

    private static function getRandomPin()
    {
        return random_int(1000, 9999);
    }

    private static function getExistingPins()
    {
        return array_merge(
            College::pluck('pin')->all(), University::pluck('pin')->all()
        );
    }
}
