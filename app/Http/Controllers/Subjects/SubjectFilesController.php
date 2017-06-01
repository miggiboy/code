<?php

namespace App\Http\Controllers\Subjects;

use Storage;

use App\Subject;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileSystem\StoreFileRequest;

class SubjectFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    public function index(Subject $subject)
    {
        $subject->load(['fileCategories', 'files' => function ($query) {
            $query->latest();
        }]);

        return view('subjects.files.index', compact('subject'));
    }

    public function store(Subject $subject, StoreFileRequest $request)
    {
        File::storeFilesFor($subject, $request);

        return back();
    }

    public function destroy(Subject $subject, File $file)
    {
        $file->delete();

        Storage::delete($file->path);

        return back()->with('message', 'Файл удален');
    }
}
