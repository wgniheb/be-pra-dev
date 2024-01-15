<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $role = Role::all();

        return response()->json($role);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:roles',
            'permission' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $role = Role::create([
            'name' => request('name'),
        ]);

        foreach ($request->permission as $permission) {
            RoleHasPermission::create([
                'role_id' => $role->id,
                'permission_id' => $permission
            ]);
        }

        if ($role) {
            return response()->json(['message' => 'Role Successfully Added!']);
        } else {
            return response()->json(['message' => 'Role Failed Added!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $role)
    {
        $detail = Role::where('id', $role)->first();
        $permission = RoleHasPermission::with('permission')->where('role_id', $role)->get();
        return response()->json(['role' => $detail, 'permissions' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $role)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'permission' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        Role::where('id', $role)->update([
            'name' => $request->name,
        ]);

        RoleHasPermission::where('role_id', $role)->delete();
        foreach ($request->permission as $permission) {
            RoleHasPermission::create([
                'role_id' => $role,
                'permission_id' => $permission
            ]);
        }

        return response()->json(['message' => 'Success Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $role)
    {
        Role::where('id', $role)->delete();
        RoleHasPermission::where('role_id', $role)->delete();
        return response()->json(['message' => 'Data Successfully Deleted!']);
    }
}
