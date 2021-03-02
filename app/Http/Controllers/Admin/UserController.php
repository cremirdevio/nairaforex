<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $paginate = 25;

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Returns the list of all users
        $users = User::simplePaginate($this->paginate);
        // return $users;
        return view('admin.users', compact('users'));
    }

    public function search() {
        // Returns the search result for a user
        $user = User::search(request()->username)->first();

        $view = view()->make('admin.user_search', compact('user'))->render();
        return Response::json(['user' => $view]);
    }

    public function role_user_search() {
        // Returns the search result for a user
        $user = User::search(request()->username)->first();
        $roles = Role::all();

        $view = view()->make('admin.role_user_search', compact('user', 'roles'))->render();
        return Response::json(['user' => $view]);
    }

    public function attachRole(Request $request) {
        $user = User::find($request->user);
        $role = Role::where('name', $request->role)->first();

//        return $request;
        $user->assignRole($role);

        return back()->with('success', 'The user has been assigned to the role successfully!');
    }

    public function detachRole(Request $request) {
        $user = User::find($request->user);
        $role = Role::where('name', $request->role)->first();

        $user->removeRole($role);

        return back()->with('success', 'The user has been removed from the role successfully!');
    }

    public function roles() {
        $roles = Role::with('users')->get();


        if (count($roles) == 0) {
//            Create the necessary roles
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'funder']);
            Role::create(['name' => 'compiler']);
            Role::create(['name' => 'customer service']);
        }

        return view('admin.users-roles', compact('roles'));
    }

}