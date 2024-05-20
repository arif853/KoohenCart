<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('name', '!=','Super Admin')->get();
        $roles = Role::all();
        return view('admin.user-role.user.index',['users' => $users, 'roles' =>$roles]);
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
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'user_role' => 'required'
        ]);

        // If validation fails, return the errors as JSON response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        // If validation passes, create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Assign roles to the user
        $user->syncRoles($request->user_role);

        // Flash success message
        Session::flash('success', 'New user added successfully.');

        // Return success response
        return response()->json(['status' => 200]);
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
    public function edit(Request $request)
    {   
        $userId = $request->id;
        $user = User::find($userId);
        $user->roles = $user->getRoleNames();
       //  dd(json_encode($user));
       return response()->json(['status' => 200, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        // If validation fails, return the errors as JSON response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password))
        {
            $data += [
                'password' => $request->password,
            ];
        }
        $user->update($data);
        $user->syncRoles($request->user_role);

        Session::flash('success', 'User Updated successfully.');

        return response()->json(['status'=>200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);

        $user->delete();
        Session::flash('success','User Deleted successfully!!');

        return redirect()->back();
    }
}