<?php

namespace App\Http\Controllers\Specialities;

use Illuminate\Http\Request;
use App\Models\Specialty\Direction;
use App\Http\Controllers\Controller;

class DirectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::all();
        return view('directions.index', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('directions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|max:255'
        ]);

        Direction::create(request(['title']));

        return redirect()->route('directions')->with('message', 'Нправление добавлено.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        return view('directions.show', compact('direction'));
    }
}
