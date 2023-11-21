<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntityController extends Controller
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
        $user = Entity::all();
        $user = array('data' => $user);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:entities',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $entity = Entity::create([
            'name' => request('name'),
            'address' => request('address'),
        ]);

        if ($entity) {
            return response()->json(['message' => 'Successfully Create Entity!']);
        } else {
            return response()->json(['message' => 'Failed to create Entity!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $entity)
    {
        $detail = Entity::where('id', $entity)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $entity)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $e = Entity::where('id', $entity)->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        if ($e) {
            return response()->json(['message' => 'Successfully Update Entity!']);
        } else {
            return response()->json(['message' => 'Failed to Update Entity!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $entity)
    {
        $e = Entity::where('id', $entity)->delete();
        if ($e) {
            return response()->json(['message' => 'Successfully Delete Entity!']);
        } else {
            return response()->json(['message' => 'Failed to Delete Entity!']);
        }
    }
}