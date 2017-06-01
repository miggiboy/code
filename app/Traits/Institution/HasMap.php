<?php

namespace App\Traits\Institution;

trait HasMap
{
    public function getResizedMap($width = null, $height = null)
    {
        $map = $this->map->source_code;

        if ($width) {
            $map = preg_replace(
                '/width(\s?)=(\s?)\"(\d+)\"/u', 'width=' . "\"{$width}\"", $map
            );
        }

        if ($height) {
            $map = preg_replace(
                '/height(\s?)=(\s?)\"(\d+)\"/u', 'height=' . "\"{$height}\"", $map
            );
        }

        return $map;
    }

    public function map()
    {
        return $this->morphOne('\App\Map', 'mapable');
    }
}
