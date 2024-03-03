<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use Illuminate\Http\Request;
use App\Models\StakeholderHasCity;
use App\Models\StakeholderHasVillage;
use App\Models\StakeholderHasDistrict;
use App\Models\StakeholderHasProvince;
use Illuminate\Support\Facades\Validator;

class StakeholderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json(Stakeholder::with('stakeholderCategory')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'phone_number' => 'required',
            'stakeholder_category_id' => 'required',
            'stakeholder_province' => 'required|array|min:1',
            'stakeholder_city' => 'required|array|min:1',
            'stakeholder_district' => 'required|array|min:1',
            'stakeholder_village' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $stakeholder = Stakeholder::create([
            'name' => request('name'),
            'phone_number' => request('phone_number'),
            'stakeholder_category_id' => request('stakeholder_category_id'),
        ]);

        foreach (request('stakeholder_province') as $province) {
            StakeholderHasProvince::create([
                'stakeholder_id' => $stakeholder->id,
                'province_id' => $province,
            ]);
        }

        foreach (request('stakeholder_city') as $city) {
            StakeholderHasCity::create([
                'stakeholder_id' => $stakeholder->id,
                'city_id' => $city,
            ]);
        }

        foreach (request('stakeholder_district') as $district) {
            StakeholderHasDistrict::create([
                'stakeholder_id' => $stakeholder->id,
                'district_id' => $district,
            ]);
        }

        foreach (request('stakeholder_village') as $village) {
            StakeholderHasVillage::create([
                'stakeholder_id' => $stakeholder->id,
                'village_id' => $village,
            ]);
        }

        if ($stakeholder) {
            return response()->json(['message' => 'Stakeholder Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Failed Added!']);
        }
    }

    public function show(int $params)
    {
        $stakeholder = Stakeholder::where('id', $params)->with('stakeholderCategory')->first();
        $province_area = StakeholderHasProvince::where('stakeholder_id', $params)->with('province')->get();
        $city_area = StakeholderHasCity::where('stakeholder_id', $params)->with('city')->get();
        $district_area = StakeholderHasDistrict::where('stakeholder_id', $params)->with('district')->get();
        $village_area = StakeholderHasVillage::where('stakeholder_id', $params)->with('village')->get();
        return response()->json(
            [
                'stakeholder_data' => $stakeholder,
                'province_area' => $province_area,
                'city_area' => $city_area,
                'district_area' => $district_area,
                'village_area' => $village_area,
            ]
        );
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'phone_number' => 'required',
            'stakeholder_category_id' => 'required',
            'stakeholder_province' => 'required|array|min:1',
            'stakeholder_city' => 'required|array|min:1',
            'stakeholder_district' => 'required|array|min:1',
            'stakeholder_village' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        StakeholderHasProvince::where('stakeholder_id', $id)->delete();
        StakeholderHasCity::where('stakeholder_id', $id)->delete();
        StakeholderHasDistrict::where('stakeholder_id', $id)->delete();
        StakeholderHasVillage::where('stakeholder_id', $id)->delete();

        foreach (request('stakeholder_province') as $province) {
            StakeholderHasProvince::create([
                'stakeholder_id' => $id,
                'province_id' => $province,
            ]);
        }

        foreach (request('stakeholder_city') as $city) {
            StakeholderHasCity::create([
                'stakeholder_id' => $id,
                'city_id' => $city,
            ]);
        }

        foreach (request('stakeholder_district') as $district) {
            StakeholderHasDistrict::create([
                'stakeholder_id' => $id,
                'district_id' => $district,
            ]);
        }

        foreach (request('stakeholder_village') as $village) {
            StakeholderHasVillage::create([
                'stakeholder_id' => $id,
                'village_id' => $village,
            ]);
        }

        $stakeholder = Stakeholder::where('id', $id)->update([
            'name' => request('name'),
            'phone_number' => request('phone_number'),
            'stakeholder_category_id' => request('stakeholder_category_id'),
        ]);

        if ($stakeholder) {
            return response()->json(['message' => 'Stakeholder Successfully Updated!'], 201);
            // return response()->json($shp, 201);
        } else {
            return response()->json(['message' => 'Stakeholder Failed Updated!']);
        }
    }

    public function destroy(int $stakeholder)
    {
        $shp = StakeholderHasProvince::where('stakeholder_id', $stakeholder)->delete();
        $shc =StakeholderHasCity::where('stakeholder_id', $stakeholder)->delete();
        $shd = StakeholderHasDistrict::where('stakeholder_id', $stakeholder)->delete();
        $shv = StakeholderHasVillage::where('stakeholder_id', $stakeholder)->delete();
        $stakeholder = Stakeholder::where('id', $stakeholder)->delete();
        if ($stakeholder && $shp && $shc && $shd && $shv) {
            return response()->json(['message' => 'Stakeholder Successfully Deleted!'], 201);
        }
    }
}
