<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\RiskIssue;
use Illuminate\Http\Request;
use App\Models\IssueAnalysis;
use Illuminate\Support\Facades\Validator;

class IssueAnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(int $id)
    {
        $issueAnalysis = IssueAnalysis::with('matrix:id,name,description')
        ->select(['id', 'issue_id', 'matrix_id', 'score'])
        ->where('issue_id', $id)
        ->get();
        return response()->json($issueAnalysis);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'issue_id' => 'required',
            'matrix_id' => 'required',
            'score' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $issueAnalysis = IssueAnalysis::create($request->all());
        
        if ($issueAnalysis) {
            $this->updateRiskIssue($request->issue_id);
            return response()->json(['message' => 'Successfully Create Analysis!'], 201);
        } else {
            return response()->json(['message' => 'Failed to Create Analysis!']);
        }
    }

    public function show(int $id){
        $issueAnalysis = IssueAnalysis::with('matrix:id,name,description')
        ->select(['id', 'issue_id', 'matrix_id', 'score'])
        ->where('id', $id)
        ->first();
        return response()->json($issueAnalysis);
    }

    public function update(Request $request){
        $validator = Validator::make(request()->all(),[
            'analysis_id' => 'required',
            'score' => 'required',
        ]);
        if ($validator->fails()) {  
            return response()->json($validator->errors(), 422);
        }
        $issueAnalysis = IssueAnalysis::find($request->analysis_id);
        $issueAnalysis->update($request->all());

        if ($issueAnalysis) {
            $this->updateRiskIssue($issueAnalysis->issue_id);
            return response()->json(['message' => 'Successfully Update Analysis!'], 200);
        } else {
            return response()->json(['message' => 'Failed to Update Analysis!']);
        }
    }

    public function destroy(int $id){
        $issueAnalysis = IssueAnalysis::find($id);
        $issue_id = $issueAnalysis->issue_id;
        $issueAnalysis->delete();

        if ($issueAnalysis) {
            $this->updateRiskIssue($issue_id);
            return response()->json(['message' => 'Successfully Delete Analysis!'], 200);
        } else {
            return response()->json(['message' => 'Failed to Delete Analysis!']);
        }
    }

    private function updateRiskIssue(int $id)
    {
        $issueAnalysis = IssueAnalysis::where('issue_id', $id)->get();
        $score = 0;
        $looping = 0;
        foreach ($issueAnalysis as $analysis) {
            $score += $analysis->score;
            $looping++;
        }

        if($looping == 0){
            
        }else{
            $score = $score / $looping;
        }
        
        $riskIssue = new RiskIssue();

        if($score >= 0 && $score <= 1){
            $riskIssue = RiskIssue::where('name', 'Insignificant')->first();
        } else if ($score > 1 && $score < 2){
            $riskIssue = RiskIssue::where('name', 'Minor')->first();
        } else if ($score >= 2 && $score < 3){
            $riskIssue = RiskIssue::where('name', 'Significant')->first();
        } else if ($score >= 3 && $score < 4){
            $riskIssue = RiskIssue::where('name', 'Major')->first();
        } else if ($score >= 4 && $score <= 5){
            $riskIssue = RiskIssue::where('name', 'Severe')->first();
        } 

        $issue = Issue::find($id);
        $issue->risk_issue_id = $riskIssue->id;
        $issue->save();
    }
}
