<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Institution\Institution;
use Spatie\MediaLibrary\Media;

class InstitutionLogosController extends Controller
{
    public function update(Institution $institution, $image)
    {
        $image = Media::find($image);

        if ($image->collection_name === 'images') {
            $this->toLogo($institution, $image);
        } else {
            $this->toImage($image);
        }

        return response()->json([null, 200]);
    }

    private function toLogo(Institution $institution, Media $image)
    {
        $logos = $institution->getMedia('logo');

        // Shouldn't be many
        foreach ($logos as $logo) {
            $logo->update(['collection_name' => 'images']);
        }

        $image->update(['collection_name' => 'logo']);
    }

    private function toImage(Media $logo)
    {
        $logo->update(['collection_name' => 'images']);
    }
}
