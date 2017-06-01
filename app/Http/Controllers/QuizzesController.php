<?php

namespace App\Http\Controllers;

use App\Subject;
use App\{Quiz, Answer};

use App\Modules\Quiz\{QuizParsing, QuizStoring};

use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with('subject')->withCount('questions')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();

        return view('quizzes.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $storage = new QuizStoring();

        $storage->add(
            session('title'),
            session('subject_id'),
            session('comment'),
            session('questions'),
            session('answers')
        );

        session()->forget(['title', 'subject_id', 'comment', 'questions', 'answers']);

        return redirect()->route('quizzes')->with('message', 'Тест успешно сохранен.');
    }

    public function preview(Request $request)
    {
        $this->validate($request, [
            'title'            => 'required|unique:quizzes',
            'subject_id'       => 'required',
            'text'             => 'required',
        ]);

        $p = new QuizParsing();
        $parsed = $p->parse($request->text);

        session([
            'title'             => $request->title,
            'subject_id'        => $request->subject_id,
            'comment'           => $request->comment,
            'questions'         => $parsed['questions'],
            'answers'           => $parsed['answers'],
        ]);

        return view('quizzes.preview')->with('message', 'Проверьте все вопросы!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions()->paginate(5);
        return view('quizzes.show', compact('quiz', 'questions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return back()->with('message', 'Тест удален.');
    }

    public function restore($id)
    {
        Quiz::withTrashed('id', $id)->restore();
        return ['message' => 'Item restored'];
    }

    public function check($answerId)
    {

        $answerId = Answer::find($answerId)->question
            ->getRightAnswer()
            ->id;

        return [
            'right_answer_id' => $answerId
        ];
    }
}
