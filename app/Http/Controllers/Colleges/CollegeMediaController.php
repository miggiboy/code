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
}
