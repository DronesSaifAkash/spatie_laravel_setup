<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    
    public function __construct(){
        $this->middleware('permission:Create Role', ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:View role', ['only' => ['index']]);
        $this->middleware('permission:Update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:Delete role', ['only' => ['destroy']]);
    }


    public function index(){
        $roles = Role::get();
        return view('role-permission.roles.index',[
            'roles' => $roles
        ]);
    }

    public function create(){
        return view('role-permission.roles.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect('roles')->with('status', 'Role Created Successfully.');
    }


    public function edit(Role $role){

        return view('role-permission.roles.edit',[
            'role' => $role
        ]);
    }


    public function update(Request $request, Role $role){
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect('roles')->with('status', 'Role Updated Successfully.');
        
    }

    public function destroy($id){
        $role = Role::find($id);
        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted Successfully.');
    }

    public function addPermissionToRole($id){
        $permissions = Permission::get();
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('role-permission.roles.add-permissions',[
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);

    }

    public function givePermissionToRole(Request $request, $roleId){
        $request->validate([
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        
        return redirect()->back()->with('status','Permissions added to role');
    }
}
