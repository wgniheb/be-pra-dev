<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /*
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $permission = Permission::all();

        return response()->json($permission);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'slug' => 'required|unique:permissions',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $permission = Permission::create([
            'slug' => request('slug'),
            'name' => request('name'),
        ]);

        if ($permission) {
            return response()->json(['message' => 'Permission Successfully Added!']);
        } else {
            return response()->json(['message' => 'Permission Failed Added!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $permission)
    {
        $detail = Permission::where('id', $permission)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $permission)
    {
        $validator = Validator::make(request()->all(),[
            'slug' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        Permission::where('id', $permission)->update([
            'slug' => $request->slug,
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Permission Successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $permission)
    {
        $permission = Permission::where('id', $permission)->delete();

        if ($permission) {
            return response()->json(['message' => 'Permission Successfully Deleted!']);
        } else {
            return response()->json(['message' => 'Permission Failed Deleted!']);
        }
    }
}
