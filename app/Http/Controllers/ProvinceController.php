<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
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
        return response()->json($provinces = Province::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:provinces',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $province = Province::create([
            'name' => request('name'),
        ]);

        if ($province) {
            return response()->json(['message' => 'Province Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Province Failed Added!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $province)
    {
        $province = Province::where('id', $province)->first();
        return response()->json($province);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $province)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:provinces',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $province = Province::where('id', $province)->update([
            'name' => request('name'),
        ]);

        if ($province) {
            return response()->json(['message' => 'Province Successfully Updated!']);
        } else {
            return response()->json(['message' => 'Province Failed Updated!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $province)
    {
        $province = Province::where('id', $province)->delete();
        if ($province) {
            return response()->json(['message' => 'Province Successfully Deleted!']);
        } else {
            return response()->json(['message' => 'Province Failed Deleted!']);
        }
    }
}
