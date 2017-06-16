<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vinkla\Pusher\Facades\Pusher;

use App\Models\User\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->with(['user'])->take(30)->get();

        return view('home', compact('news'));
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
            'body' => 'required'
        ]);

        auth()->user()->publish(
            $message = new News(request(['body']))
        );

        Pusher::trigger('global-channel', 'message-sent', [
            'message' => $message,
            'user' => auth()->user(),
        ]);

        return response([
            'user' => auth()->user(),
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if (auth()->user()->owns($news)) {
            $news->delete();
        }

        return redirect()->home();
    }
}
