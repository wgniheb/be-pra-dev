<?php

namespace App\Http\Controllers;

use App\Models\IdmStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdmStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json($idmStatus = IdmStatus::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $idmStatus = IdmStatus::create([
            'name' => request('name'),
        ]);

        if ($idmStatus) {
            return response()->json(['message' => 'IDM Status Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'IDM Status Failed Added!']);
        }
    }

    public function show(int $idmStatus)
    {
        $idmStatus = IdmStatus::where('id', $idmStatus)->first();
        return response()->json($idmStatus);
    }

    public function update(Request $request, int $idmStatus)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $idmStatus = IdmStatus::where('id', $idmStatus)->update([
            'name' => request('name'),
        ]);

        if ($idmStatus) {
            return response()->json(['message' => 'IDM Status Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'IDM Status Failed Updated!']);
        }
    }

    public function destroy(int $idmStatus)
    {
        $idmStatus = IdmStatus::where('id', $idmStatus)->delete();
        if ($idmStatus) {
            return response()->json(['message' => 'IDM Status Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'IDM Status Failed Deleted!']);
        }
    }
}
