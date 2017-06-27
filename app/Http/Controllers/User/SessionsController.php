<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\User\{
    StoreSessionRequest
};

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {
        if (! auth()->attempt(request(['email', 'password']), request()->has('remember'))
        ) {
            $request->flashOnly(['email']);
            return back()->withMessage('Логин или пароль не верны');
        }

        if (! auth()->user()->isAuthorised()) {
            auth()->logout();
            return redirect()->route('sessions.create')->withMessage('Вам еще не предоставлен доступ');
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->logout();
        return redirect()->home();
    }
}
