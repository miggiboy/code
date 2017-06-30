<?php

namespace App\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject\Subject;

class SubjectSpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $subject)
    {
        $specialties = $subject->getSpecialties()
            ->with(['direction', 'subjects'])
            ->orderBy('title')
            ->get();

        return view('subjects.specialties.index', compact('subject', 'specialties'));
    }
}
