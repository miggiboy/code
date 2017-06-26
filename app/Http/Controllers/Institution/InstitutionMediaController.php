<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Institution\Institution;
use App\Http\Requests\ImageRequest;

use Spatie\MediaLibrary\Media;

class InstitutionMediaController extends Controller
{
    public function store(ImageRequest $request, Institution $institution)
    {
        foreach ($request->file('images') as $image) {
            $institution
                ->addMedia($image)
                ->usingFileName(
                    uniqid(true) . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION)
                )
                ->toMediaCollection($request->collection);
        }

        return back()->withMessage('Изображения добавлены');
    }

    public function destroy($mediaId)
    {
        $media = Media::find($mediaId);
        $media->delete();

        return response([
            null, 200
        ]);
    }

    public function toggleLogo($institutionID, $mediaId)
    {
        $media = Media::find($mediaId);

        if ($media->collection_name == 'logo') {
            $media->update(['collection_name' => 'images']);
        } else {
            $media->update(['collection_name' => 'logo']);
        }

        $institution = Institution::find($institutionID);

        $logos = $institution->getMedia('logo');

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
