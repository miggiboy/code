<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User\{User, Role};

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role:' . config('entrust.roles.groups.role_managers')
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->withMessage('Пользователь удален');
    }
}
