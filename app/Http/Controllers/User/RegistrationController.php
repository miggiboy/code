<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\User\{
    StoreUserRequest
};
use App\Models\User\User;

use Identicon\Identicon;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.registration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'identicon'     => (new Identicon)->getImageDataUri($request->email) // TODO: fails
        ]);

       return redirect()
            ->route('login')
            ->withMessage(
                'Вы зарегистрированы. Обратитесь к администраторам для получения доступа'
            );
    }
}
