<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\IssueStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issue = Issue::with('entity:id,name')
        // ->with('issueCategory:id,name')
        // ->with('stakeholder:id,name')
        ->with('publishedStatus:id,name')
        ->with('issueStatus:id,name')
        ->select(['id', 'name', 'issue_category_id', 'entity_id', 'stakeholder_id', 'published_status_id', 'period', 'issue_status_id'])
        ->get();
        return response()->json($issue);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'issue_name' => 'required',
            'issue_detail' => 'required',
            'issue_category' => 'required',
            'entity' => 'required',
            'stakeholder' => 'required',
            'published_status' => 'required',
            'period' => 'required',
            'stakeholder_perception' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $status = IssueStatus::where('name', 'Open')->first();

        $issue = Issue::create([
            'name' => request('issue_name'),
            'issue_detail' => request('issue_detail'),
            'issue_category_id' => request('issue_category'),
            'entity_id' => request('entity'),
            'stakeholder_id' => request('stakeholder'),
            'published_status_id' => request('published_status'),
            'period' => request('period'),
            'stakeholder_perception' => request('stakeholder_perception'),
            'issue_status_id' => $status->id,
        ]);

        if ($issue) {
            return response()->json(['message' => 'Successfully Create Issue!']);
        } else {
            return response()->json(['message' => 'Failed to create Issue!']);
        }
    }
}
