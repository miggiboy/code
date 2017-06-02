<?php

namespace App\Http\Controllers\Colleges;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\College\College;
use App\Http\Requests\ImageRequest;

class CollegeMediaController extends Controller
{
    public function store(College $college, ImageRequest $request)
    {
        foreach ($request->file('images') as $image) {
            $college->addMedia($image)->toMediaCollection($request->collection);
        }

        return back()->with('message', 'Изображения добавлены');
    }

    public function destroy($mediaId)
    {
        $media = \Spatie\MediaLibrary\Media::find($mediaId);
        $media->delete();

        return response([
            null, 200
        ]);
    }

    public function toggleLogo($collegeId, $mediaId)
    {
        $media = \Spatie\MediaLibrary\Media::find($mediaId);

        if ($media->collection_name == 'logo') {
            $media->update(['collection_name' => 'images']);
        } else {
            $media->update(['collection_name' => 'logo']);
        }

        $college = College::find($collegeId);

        $logos = $college->getMedia('logo');

        foreach ($logos as $logo) {
            if ($logo->id !== $media->id) {
                $logo->update(['collection_name' => 'images']);
            }
        }

        return response([
            null, 200
        ]);
    }
}
