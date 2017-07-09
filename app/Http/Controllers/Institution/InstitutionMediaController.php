<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Institution\Institution;
use App\Http\Requests\ImageRequest;

use Spatie\MediaLibrary\Media;

use App\Support\Traits\File\ComposesFileName;

class InstitutionMediaController extends Controller
{
    /**
     * Custom trait
     */
    use ComposesFileName;

    public function store(ImageRequest $request, Institution $institution)
    {
        $this->attachImages($institution, $request);

        return back()->withMessage('Изображения добавлены');
    }

    public function destroy($mediaId)
    {
        $media = Media::find($mediaId);
        $media->delete();

        return response([null, 200]);
    }

    private function attachImages(Institution $institution, $request)
    {
        foreach ($request->file('images') as $image) {
            $institution
                ->addMedia($image)
                ->usingFileName(
                    $this->composeFileName($image)
                )
                ->toMediaCollection($request->collection);
        }
    }
}
