<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Models\UserHasEntity;
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
        $user = User::with('role', 'userstatus')->get();
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
            'password' => 'required',
            'phone_number' => 'numeric|nullable|digits_between:10,13',
            'role_id'=> 'required',
            'entity' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 201);
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'phone_number' => request('phone_number'),
            'userstatus_id' => 1,
            'role_id' => request('role_id'),
        ]);

        foreach ($request->entity as $entity) {
            UserHasEntity::create([
                'user_id' => $user->id,
                'entity_id' => $entity
            ]);
        }

        $role = new Role;
        $role->id = $request->get('role_id');

        $status = new UserStatus;
        $status->id = 1;

        $user->role()->associate($role);
        $user->save();
        $user->userstatus()->associate($status);
        $user->save();

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
        $detail = User::with('role', 'userstatus')->where('id', $user)->first();
        $entity = UserHasEntity::with('entity')->where('user_id', $user)->get();

        return response()->json(['data' => $detail, 'entity' => $entity]);

        // $detail = User::with('role', 'userstatus')->where('id', $user)->first();
        // $entity = UserHasEntity::with(['entity' => function ($query) {
        //     $query->withTrashed();}])->where('user_id', $user)->get();

        // return response()->json(['data' => $detail, 'entity' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $user)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'numeric|nullable|digits_between:10,13',
            'role_id'=> 'required',
            'userstatus_id' => 'required',
            'entity' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        User::where('id', $user)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_status_id' => $request->userstatus_id,
            'role_id' => $request->role_id
        ]);

        UserHasEntity::where('user_id', $user)->delete();

        foreach ($request->entity as $entity) {
            UserHasEntity::create([
                'user_id' => $user,
                'entity_id' => $entity
            ]);
        }

        return response()->json(['message' => 'Success Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user)
    {
        User::where('id', $user)->delete();
        UserHasEntity::where('user_id', $user)->delete();
        return response()->json(['message' => 'Data Successfully Deleted!']);
    }
}
