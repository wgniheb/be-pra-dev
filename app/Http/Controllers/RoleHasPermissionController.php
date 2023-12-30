<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\Validator;

class RoleHasPermissionController extends Controller
{
    public function index()
    {
        $roleHasPermission = RoleHasPermission::with('role', 'permission')->get();

        return response()->json($roleHasPermission);
    }

    public function store(Request $request){
        $validator = Validator::make(request()->all(),[
            'role_id' => 'required',
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        foreach (request('permission') as $permission) {
            $roleHasPermission = RoleHasPermission::create([
                'role_id' => request('role_id'),
                'permission_id' => $permission,
            ]);
        }

        $result = RoleHasPermission::where('role_id', request('role_id'))->get();

        return response()->json($result);
    }
}
