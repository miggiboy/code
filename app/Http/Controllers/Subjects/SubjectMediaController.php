<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

use App\Http\Requests\FileSystem\{
    StoreFileRequest
};

use Spatie\MediaLibrary\Media;

class SubjectMediaController extends Controller
{
    public function index(Subject $subject)
    {
        $subject->load(['fileCategories', 'media' => function ($query) {
            $query->latest();
        }]);

        return view('subjects.files.index', compact('subject'));
    }

    public function store(Subject $subject, StoreFileRequest $request)
    {
        foreach ($request->file('files') as $image) {
            $subject
                ->addMedia($image)
                ->usingName(
                    $image->getClientOriginalName()
                )
                ->usingFileName(
                    str_slug(
                        $image->getClientOriginalName()
                    )
                    . '.'
                    . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION)
                )
                ->toMediaCollection($request->category);
        }

        return back();
    }

    public function destroy(Subject $subject, Media $media)
    {
        $media->delete();
        return back()->with('message', 'Файл удален');
    }
}
