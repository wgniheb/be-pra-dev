<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        if($request->has('district_id')){
            $district_id = $request->input('district_id', []);
            $village = collect();

            foreach ($district_id as $id) {
                $village = $village->merge(Village::where('district_id', $id)->get());
            }

            return response()->json($village);
        }else{
            return response()->json($village = Village::with('district', 'city', 'province')->get());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'district_id' => 'required|exists:districts,id',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $village = Village::create([
            'name' => request('name'),
            'district_id' => request('district_id'),
            'city_id' => request('city_id'),
            'province_id' => request('province_id'),
        ]);

        if ($village) {
            return response()->json(['message' => 'Village Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Village Failed Added!']);
        }
    }

    public function show(int $village)
    {
        $village = Village::where('id', $village)->with('district', 'city', 'province')->first();
        return response()->json($village);
    }

    public function update(Request $request, int $village)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'district_id' => 'required|exists:districts,id',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $village = Village::where('id', $village)->update([
            'name' => request('name'),
            'district_id' => request('district_id'),
            'city_id' => request('city_id'),
            'province_id' => request('province_id'),
        ]);

        if ($village) {
            return response()->json(['message' => 'Village Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'Village Failed Updated!']);
        }
    }

    public function destroy(int $village)
    {
        $village = Village::where('id', $village)->delete();
        if ($village) {
            return response()->json(['message' => 'Village Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'Village Failed Deleted!']);
        }
    }
}
