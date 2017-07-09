<?php

namespace App\Support\Traits\File;

trait ComposesFileName
{
    private function composeFileName($file)
    {
        return str_slug($file->getClientOriginalName()) . '.' . $file->extension();
    }
}
