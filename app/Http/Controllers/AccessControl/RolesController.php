<?php

namespace App\Http\Controllers\AccessControl;

use App\{User, Role, Permission};
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:developer|admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('acl.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('acl.roles.create', compact('permissions'));
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
            'name'              => 'required|unique:roles',
            'display_name'      => 'required|unique:roles',
        ]);

        $role = Role::create(request(['name', 'display_name', 'description']));

        foreach (request('permissions') as $permission){
            $role->attachPermission($permission);
        }

        return back()->with('message', 'Роль успешно создана.');
    }

    public function assign()
    {
        $roles = Role::all();
        return view('acl.roles.assign', compact('roles'));
    }

    public function assignStore()
    {
        $this->validate(request(), [
            'login' => 'required',
            'role'  => 'required'
        ]);

        $user = User::where('username', request('login'))->first();

        //DB::table('role_user')->where('user_id',$id)->delete();

        $user->attachRole(request('role'));

        session()->flash('message', 'Роль успешно присвоена пользователю.');
        return back();
    }
}
