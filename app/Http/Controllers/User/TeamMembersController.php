<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User\{User, Role};

class TeamMembersController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role:' . config('entrust.roles.groups.role_managers')
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = User::team()
            ->with(['roles'])
            ->oldest()
            ->get();

        $roles = Role::all();

        return view('users.team-members.index', compact('team', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newComers = User::doesntHave('roles')
            ->with(['roles'])
            ->latest()
            ->get();

        $roles = Role::all();

        return view ('users.team-members.create', compact('newComers', 'roles'));
    }
}
