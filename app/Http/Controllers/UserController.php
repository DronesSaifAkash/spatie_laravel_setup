<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('permission:Create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:View User', ['only' => ['index']]);
        $this->middleware('permission:Update User', ['only' => ['update', 'edit']]);
        $this->middleware('permission:Delete User', ['only' => ['destroy']]);
    }
    
    //
    public function index(){
        $users = User::get();
        return view('role-permission.user.index',[
            'users' => $users
        ]);
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create',[
            'roles' => $roles,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:20|min:8',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User created successfully with roles');
    }

    public function edit(User $user){

        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit',[
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    public function update(Request $request, User $user){

        $request->validate([
            'name' => 'required|string|max:255',
            'roles' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
        ]);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User updated successfully with roles');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('status','User deleted successfully.');
    }
}
