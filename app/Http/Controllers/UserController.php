<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all('id','name', 'email');
        $user = array('data' => $user);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        if ($user) {
            return response()->json(['message' => 'Successfully created user!']);
        } else {
            return response()->json(['message' => 'Failed to create user!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user)
    {
        $detail = User::where('id', $user)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $user)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        User::where('id', $user)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response()->json(['message' => 'Success Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user)
    {
        User::where('id', $user)->delete();
        return response()->json(['message' => 'Data Successfully Deleted!']);
    }
}
