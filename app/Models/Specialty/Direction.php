<?php

namespace App\Models\Specialty;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['title'];

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
     * Get university specialty directions
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getUniversitySpecialitiesDirections()
    {
        return static::where('institution', 1)->orderBy('title')->get();
    }

    /**
     * Get college specialty directions
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCollegeSpecialitiesDirections()
    {
        return static::where('institution', 0)->orderBy('title')->get();
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
