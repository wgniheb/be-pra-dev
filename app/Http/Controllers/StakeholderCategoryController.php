<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StakeholderCategory;
use Illuminate\Support\Facades\Validator;

class StakeholderCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json($stakeholderCategory = StakeholderCategory::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $stakeholderCategory = StakeholderCategory::create([
            'name' => request('name'),
        ]);

        if ($stakeholderCategory) {
            return response()->json(['message' => 'Stakeholder Category Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Category Failed Added!']);
        }
    }

    public function show(int $stakeholderCategory)
    {
        $stakeholderCategory = StakeholderCategory::where('id', $stakeholderCategory)->first();
        return response()->json($stakeholderCategory);
    }

    public function update(Request $request, int $stakeholderCategory)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $stakeholderCategory = StakeholderCategory::where('id', $stakeholderCategory)->update([
            'name' => request('name'),
        ]);

        if ($stakeholderCategory) {
            return response()->json(['message' => 'Stakeholder Category Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Category Failed Updated!']);
        }
    }

    public function destroy(int $stakeholderCategory)
    {
        $stakeholderCategory = StakeholderCategory::where('id', $stakeholderCategory)->delete();
        if ($stakeholderCategory) {
            return response()->json(['message' => 'Stakeholder Category Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Category Failed Deleted!']);
        }
    }
}
