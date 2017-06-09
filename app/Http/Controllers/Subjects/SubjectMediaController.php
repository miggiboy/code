<?php

namespace App\Http\Controllers\Subjects;

use Storage;

use App\Subject;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileSystem\StoreFileRequest;

use Spatie\MediaLibrary\Media;

class SubjectMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

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
                ->usingFileName(
                    str_slug(
                        pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
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
