<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response()->json($city = City::with('province')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $city = City::create([
            'name' => request('name'),
            'province_id' => request('province_id'),
        ]);

        if ($city) {
            return response()->json(['message' => 'City Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'City Failed Added!']);
        }
    }

    public function show(int $city)
    {
        $city = City::where('id', $city)->with('province')->first();
        return response()->json($city);
    }

    public function update(Request $request, int $city)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $city = City::where('id', $city)->update([
            'name' => request('name'),
            'province_id' => request('province_id'),
        ]);

        if ($city) {
            return response()->json(['message' => 'City Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'City Failed Updated!']);
        }
    }

    public function destroy(int $city)
    {
        $city = City::where('id', $city)->delete();
        if ($city) {
            return response()->json(['message' => 'City Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'City Failed Deleted!']);
        }
    }
}
