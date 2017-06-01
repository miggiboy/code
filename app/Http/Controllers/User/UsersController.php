<?php

namespace App\Http\Controllers\User;

use App\{User, Role};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin|moderator');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('roles', 'user'));
    }

    public function grant(User $user)
    {
        //DB::table('role_user')->where('user_id',$id)->delete();

        foreach (request('roles') as $role) {
            $user->attachRole($role);
        }

        return back()->withMessage('Role permissions granted');
    }

    public function autocomplete(Request $request){

        $users = User::select("username")
            ->where("username", "LIKE", "%{$request->input('query')}%")
            ->get();

        return response()->json(['users' => $users]);
    }

}
