<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User\{User, Role};

class UserRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role:' . config('entrust.roles.groups.role_managers')
        );
    }

    public function store(Request $request, User $user)
    {
        $user->roles()->attach($request->role);

        return back()->withMessage('Роль присвоена пользователю');
    }

    public function destroy(User $user, Role $role)
    {
        $user->roles()->detach($role);

        return back()->withMessage('Роль отозвана');
    }
}
