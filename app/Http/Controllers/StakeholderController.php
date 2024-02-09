<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use Illuminate\Http\Request;
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
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $stakeholder = Stakeholder::create([
            'name' => request('name'),
            'phone_number' => request('phone_number'),
            'stakeholder_category_id' => request('stakeholder_category_id'),
        ]);

        if ($stakeholder) {
            return response()->json(['message' => 'Stakeholder Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Stakeholder Failed Added!']);
        }
    }

    public function show(int $stakeholder)
    {
        $stakeholder = Stakeholder::where('id', $stakeholder)->with('stakeholderCategory')->first();
        return response()->json($stakeholder);
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
