<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json($district = District::with('city', 'province')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $district = District::create([
            'name' => request('name'),
            'city_id' => request('city_id'),
            'province_id' => request('province_id'),
        ]);

        if ($district) {
            return response()->json(['message' => 'District Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'District Failed Added!']);
        }
    }

    public function show(int $district)
    {
        $district = District::where('id', $district)->with('city', 'province')->first();
        return response()->json($district);
    }

    public function update(Request $request, int $district)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $district = District::where('id', $district)->update([
            'name' => request('name'),
            'city_id' => request('city_id'),
            'province_id' => request('province_id'),
        ]);

        if ($district) {
            return response()->json(['message' => 'District Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'District Failed Updated!']);
        }
    }

    public function destroy(int $district)
    {
        $district = District::where('id', $district)->delete();
        if ($district) {
            return response()->json(['message' => 'District Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'District Failed Deleted!']);
        }
    }
}
