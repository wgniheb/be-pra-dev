<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
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
            'name' => 'required|unique:roles'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $role = Role::create([
            'name' => request('name'),
        ]);

        if ($role) {
            return response()->json(['message' => 'Role Berhasil Ditambahkan']);
        } else {
            return response()->json(['message' => 'Role Gagal Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $role)
    {
        $detail = Role::where('id', $role)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $role)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        Role::where('id', $role)->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Success Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $role)
    {
        Role::where('id', $role)->delete();
        return response()->json(['message' => 'Data Successfully Deleted!']);
    }
}
