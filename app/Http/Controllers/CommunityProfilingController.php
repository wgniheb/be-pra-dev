<?php

namespace App\Http\Controllers;

use App\Models\Idm;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\CommunityProfiling;
use App\Models\CommunityProfilingDetail;
use Illuminate\Support\Facades\Validator;

class CommunityProfilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $village = Village::with(['communityProfilings' => function ($query) {
            $query->orderBy('year', 'desc')->first(); // Assuming you want to sort by year in ascending order
        }])
        ->with('district', 'city', 'province')
        ->get();
        return response()->json($village);
    }

    public function indexByVillage(int $village)
    {
        $communityProfiling = CommunityProfiling::where('village_id', $village)->orderByDesc('year')->get();
        return response()->json($communityProfiling);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'year' => 'required',
            'village_id' => 'required|exists:villages,id',
            'idm_year' => 'required',
            'idm_score' => 'required',
            'idm_status_id' => 'required|exists:idm_statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $communityProfiling = CommunityProfiling::create([
            'year' => request('year'),
            'village_id' => request('village_id'),
        ]);

        $idm = Idm::create([
            'year' => request('idm_year'),
            'score' => request('idm_score'),
            'idm_status_id' => request('idm_status_id'),
        ]);

        $detail = CommunityProfilingDetail::create([
            'community_profiling_id' => $communityProfiling->id,
            'idm_id' => $idm->id,
        ]);

        if ($detail) {
            return response()->json(['message' => 'Community Profiling Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Added!']);
        }
    }

    public function show(int $communityProfiling)
    {
        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->with('village')->first();
        return response()->json($communityProfiling);
    }

    public function update(Request $request, int $communityProfiling)
    {
        $validator = Validator::make(request()->all(),[
            'year' => 'required',
            'village_id' => 'required|exists:villages,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->update([
            'year' => request('year'),
            'village_id' => request('village_id'),
        ]);

        if ($communityProfiling) {
            return response()->json(['message' => 'Community Profiling Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Updated!']);
        }
    }

    public function destroy(int $communityProfiling)
    {
        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->forceDelete();
        if ($communityProfiling) {
            return response()->json(['message' => 'Community Profiling Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Deleted!']);
        }
    }
}
