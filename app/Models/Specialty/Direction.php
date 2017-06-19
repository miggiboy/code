<?php

namespace App\Models\Specialty;

use App\Models\Model;

class Direction extends Model
{
    public function scopeOf($query, $institutionType)
    {
        return $query->where('institution', $institutionType);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Get specialty directions depending on the institution
     * or all directions but with `| institution` appended to direction's title
     * if no institution provided as the parameter
     *
     * @param  integer $institution
     * @return \Illuminate\Support\Collection
     */
    public static function getByInstitution($institution = null)
    {
        if ($institution == "1") {

            return static::getUniversitySpecialitiesDirections();
        } elseif ($institution == "0") {

            return static::getCollegeSpecialitiesDirections();
        }

        return static::getAllWithInstitution();
    }

    /**
     * Get all specialty directions
     * with `| institution` appended to the title of direction
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getAllWithInstitution()
    {
        $directions = static::all()->sortBy('title');

        $directions = $directions->each(function ($item, $key) {
            if ($item->institution == 1) {

                $item->title .= ' | Университет';
            } elseif ($item->institution == 0) {

                $item->title .= ' | Колледж';
            }
        });

        return $directions;
    }
}
