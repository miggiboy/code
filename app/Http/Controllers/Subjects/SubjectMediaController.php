<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

use App\Http\Requests\{
    Media\StoreFileRequest
};

use Spatie\MediaLibrary\Media;

class SubjectMediaController extends Controller
{
    public function index(Subject $subject)
    {
        $subject->load(['fileCategories', 'media' => function ($query) {
            $query->latest();
        }]);

        return view('subjects.media.index', compact('subject'));
    }

    public function store(StoreFileRequest $request, Subject $subject)
    {
        $this->attachMedia($subject, $request);

        return back()->withMessage('Файлы добавлены');
    }

    public function destroy(Subject $subject, $media)
    {
        Media::findOrFail($media)->delete();

        return back()->withMessage('Файл удален');
    }

    /**
     * Attaches media to subject from request
     *
     * @param  Subject $subject
     * @param  Request $request
     * @return void
     */
    private function attachMedia(Subject $subject, $request)
    {
        foreach ($request->file('files') as $file) {
            $subject
                ->addMedia($file)
                ->usingFileName(
                    $this->composeFileName($file)
                )
                ->toMediaCollection($request->category);
        }
    }

    private function composeFileName($file)
    {
        return str_slug($file->getClientOriginalName()) . '.' . $file->extension();
    }
}
