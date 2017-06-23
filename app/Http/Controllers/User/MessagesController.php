<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Models\User\Message;

use App\Http\Controllers\Controller;

use Auth;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')
            ->with(['user'])
            ->take(30)
            ->get();

        return view('home', compact('messages'));
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
            'text' => 'required'
        ]);

        Auth::user()->messages()->save(
            new Message(request(['text']))
        );

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        if (Auth::user()->owns($message)) {
            $message->delete();
        }

        return redirect()->route('home');
    }
}
