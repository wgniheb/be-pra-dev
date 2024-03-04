<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use Illuminate\Http\Request;
use App\Models\StakeholderProfiling;
use Illuminate\Support\Facades\Validator;
use App\Models\StakeholderProfilingDetail;

class StakeholderProfilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $stakeholder = Stakeholder::with(['stakeholderProfiling' => function ($query) {
            $query->orderBy('year', 'desc')
            ->select('id', 'stakeholder_id', 'year', 'stakeholder_kuadran_id', 'power_point', 'interest_point');
        }])
        ->with('stakeholderCategory:id,name')
        ->get(['id', 'name', 'phone_number', 'stakeholder_category_id']);

        return response()->json($stakeholder);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(),[
            'stakeholder_id' => 'required',
            'year' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'question4' => 'required',
            'question5' => 'required',
            'question6' => 'required',
            'question7' => 'required',
            'question8' => 'required',
            'question9' => 'required',
            'question10' => 'required',
            'question11' => 'required',
            'question12' => 'required',
            'question13' => 'required',
            'question14' => 'required',
            'question15' => 'required',
            'question16' => 'required',
            'question17' => 'required',
            'question18' => 'required',
            'question19' => 'required',
            'question20' => 'required',
            'question21' => 'required',
            'question22' => 'required',
            'question23' => 'required',
            'question24' => 'required',
            'question25' => 'required',
            'question26' => 'required',
            'question27' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $point_power = 
            $request->question1 
            + $request->question2 
            + $request->question3 
            + $request->question4 
            + $request->question5 
            + $request->question6 
            + $request->question7 
            + $request->question8 
            + $request->question9 
            + $request->question10 
            + $request->question11 
            + $request->question12 
            + $request->question13;

        $power_point = $point_power / 13;
        
        $point_interest =
            $request->question14 
            + $request->question15 
            + $request->question16 
            + $request->question17 
            + $request->question18 
            + $request->question19 
            + $request->question20 
            + $request->question21 
            + $request->question22 
            + $request->question23 
            + $request->question24 
            + $request->question25 
            + $request->question26 
            + $request->question27;
        
        $interest_point = $point_interest / 14;
        
        $kuadran = 4;

        if ($power_point > 1.5 && $interest_point > 1.5) {
            $kuadran = 1;
        }else if ($power_point < 1.5 && $interest_point > 1.5) {
            $kuadran = 2;
        }else if ($power_point > 1.5 && $interest_point < 1.5) {
            $kuadran = 3;
        }else if ($power_point < 1.5 && $interest_point < 1.5) {
            $kuadran = 4;
        }

        $stakeholderProfiling = StakeholderProfiling::create([
            'stakeholder_id' => $request->stakeholder_id,
            'year' => $request->year,
            'stakeholder_kuadran_id' => $kuadran,
            'power_point' => $power_point,
            'interest_point' => $interest_point,
        ]);

        $stakeholderProfilingDetail = StakeholderProfilingDetail::create([
            'stakeholder_profiling_id' => $stakeholderProfiling->id,
            'k_s1_q1' => $request->question1,
            'k_s1_q2' => $request->question2,
            'k_s1_q3' => $request->question3,
            'k_s1_q4' => $request->question4,
            'k_s1_q5' => $request->question5,
            'k_s2_q1' => $request->question6,
            'k_s2_q2' => $request->question7,
            'k_s2_q3' => $request->question8,
            'k_s2_q4' => $request->question9,
            'k_s2_q5' => $request->question10,
            'k_s2_q6' => $request->question11,
            'k_s2_q7' => $request->question12,
            'k_s2_q8' => $request->question13,
            'p_s1_q1' => $request->question14,
            'p_s1_q2' => $request->question15,
            'p_s1_q3' => $request->question16,
            'p_s1_q4' => $request->question17,
            'p_s1_q5' => $request->question18,
            'p_s1_q6' => $request->question19,
            'p_s1_q7' => $request->question20,
            'p_s2_q1' => $request->question21,
            'p_s2_q2' => $request->question22,
            'p_s2_q3' => $request->question23,
            'p_s2_q4' => $request->question24,
            'p_s2_q5' => $request->question25,
            'p_s2_q6' => $request->question26,
            'p_s2_q7' => $request->question27,
        ]);

        if ($stakeholderProfiling && $stakeholderProfilingDetail) {
            return response()->json(['message' => 'Stakeholder Profiling Successfully Added!'], 201);
        }else{
            return response()->json(['message' => 'Stakeholder Profiling Failed Added!'], 202);
        }
    }
}
