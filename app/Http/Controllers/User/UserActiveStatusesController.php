<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User\User;

class UserActiveStatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role:' . config('entrust.roles.groups.role_managers')
        );
    }

    public function update(User $user)
    {
        $user->toggleActiveStatus()->save();

        return back()->withMessage('Статус пользователя обновлен');
    }
}
