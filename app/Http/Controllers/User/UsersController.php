<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\{User, Role};

class UsersController extends Controller
{
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

    public function autocomplete(Request $request)
    {
        $users = User::select("username")
            ->where("username", "LIKE", "%{$request->input('query')}%")
            ->get();

        return response()->json(['users' => $users]);
    }

}
