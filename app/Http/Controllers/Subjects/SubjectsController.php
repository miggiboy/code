<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all()->sortBy('title');
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:subjects|max:255'
        ], [
            'title.required' => 'Название - обязательное поле.',
            'title.unique'   => 'Такой предмет уже добавлен.',
            'title.max'      => 'Слишком длинное название.',
        ]);

        Subject::create(request(['title']));

        return back()->with('message', 'Предмет добавлен успешно.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load(['media' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('subjects.show', compact('subject'));
    }
}
