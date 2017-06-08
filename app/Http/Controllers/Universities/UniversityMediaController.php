<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

use App\Http\Controllers\Controller;

use App\Models\University\University;

class UniversityMediaController extends Controller
{
    public function store(University $university, ImageRequest $request)
    {
        // TODO: Add multiple from request

        foreach ($request->file('images') as $image) {
            $university
                ->addMedia($image)
                ->usingFileName(
                    uniqid(true) . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION)
                )
                ->toMediaCollection($request->collection);
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

    public function toggleLogo($universityId, $mediaId)
    {
        $media = \Spatie\MediaLibrary\Media::find($mediaId);

        if ($media->collection_name == 'logo') {
            $media->update(['collection_name' => 'images']);
        } else {
            $media->update(['collection_name' => 'logo']);
        }

        $university = University::find($universityId);

        $logos = $university->getMedia('logo');

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
