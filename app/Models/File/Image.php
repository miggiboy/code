<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Intervention\Image\ImageManager;

class Image extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function uploadnResize($image, $width = 300)
    {
        $manager = new ImageManager(['driver' => 'gd']);

        $image = $manager->make($image);

        $path = '../public/images/gallery/' . uniqid(true);

        $image->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode('png')
        ->save($path . '.png');

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode('png')
        ->save($path . '_medium' . '.png');

        return $path . '.png';
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
