<?php

namespace App\Http\Controllers\Universities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\University\University;

use App\Http\Requests\ImageRequest;

class UniversityMediaController extends Controller
{
    public function store(University $university, ImageRequest $request)
    {
        foreach ($request->file('images') as $image) {
            $university->addMedia($image)->toMediaCollection($request->collection);
        }

        return back()->with('message', 'Изображения добавлены');
    }
}
