<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use Illuminate\Http\Request;
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
        return response()->json($stakeholder = Stakeholder::with('stakeholderCategory')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'phone_number' => 'required',
            'stakeholder_category_id' => 'required',
            'stakeholder_province' => 'required|array|min:1',
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
        return response()->json(['stakeholder_data' => $stakeholder, 'province_area' => $province_area]);
    }

    public function update(Request $request, int $stakeholder)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'stakeholder_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $stakeholder = Stakeholder::where('id', $stakeholder)->update([
            'name' => request('name'),
            'stakeholder_category_id' => request('stakeholder_category_id'),
        ]);

        if ($stakeholder) {
            return response()->json(['message' => 'Stakeholder Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Failed Updated!']);
        }
    }

    public function destroy(int $stakeholder)
    {
        $stakeholder = Stakeholder::where('id', $stakeholder)->delete();
        if ($stakeholder) {
            return response()->json(['message' => 'Stakeholder Successfully Deleted!'], 201);
        }
    }
}
