<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.user-role.role.index',['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name,
        ]);
        Session::flash('success','Role Added Successfully.');
        return response()->json(['status'=> 200]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return response()->json(['status' => 200, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|unique:roles,name'
        ]);

        $role->update([
            'name' => $request->role_name,
        ]);

        Session::flash('success', 'Role Updated Successfully.');
        return response()->json(['status' => 200]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        Session::flash('success','Role deleted Successfully.');

        return redirect()->back();
    }
    // public function addPermissionToRole($roleId){
    //     $permissions = Permission::get();
    //     $role = Role::findOrFail($roleId);
    //     $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
    //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //     ->all();
    //     return response()->json([
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'rolePermissions' => $rolePermissions
    //     ]);
      
    // }
    // public function givePermissionToRole(Request $request, $roleId){
    //     $rules = [
    //         'permission' => 'required',
    //     ];

    //     $customMessages = [
    //         'permission.required' => 'The permission name field is required.',
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $customMessages);

    //     // Validate the request
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $role = Role::findOrFail($roleId);
    //     $role->syncPermissions($request->permission);
    //     Session::flash('success', 'Permissions added to role.');
    //     return redirect()->back();
    // }
}