<?php

namespace App\Traits\Institution;

trait HasType
{
    /**
     * Retrieves institutions of $type type
     *
     * @param  Builder $query
     * @param  string $institutionType
     * @return Builder
     */
    public function scopeOfType($query, $institutionType)
    {
        return $query->where('type', str_singular($institutionType));
    }

    public function isA($type)
    {
        return strcmp($this->type, str_singular($type)) === 0;
    }

    public static function types()
    {
        return self::TYPES;
    }

    public static function hasType($type)
    {
        return in_array(str_singular($type), self::TYPES);
    }

    public static function doesntHaveType($type)
    {
        return ! static::hasType($type);
    }
}
