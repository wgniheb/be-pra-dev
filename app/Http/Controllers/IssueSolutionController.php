<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueSolution;
use Illuminate\Support\Facades\Validator;

class IssueSolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $id)
    {
        $solution = IssueSolution::withCount('issueImplementations')->where('issue_id', $id)->get();

        return response()->json($solution);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'issue_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'target' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $solution = IssueSolution::create([
            'issue_id' => $request->issue_id,
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'target' => $request->target,
            'notes' => $request->notes,
        ]);

        if ($solution) {
            return response()->json(['message' => 'Successfully Create Solution!'], 201);
        } else {
            return response()->json(['message' => 'Failed to Create Solution!']);
        }
    }

    public function show(int $id)
    {
        $solution = IssueSolution::find($id);

        return response()->json($solution);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'target' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $solution = IssueSolution::find($id);
        $solution->name = $request->name;
        $solution->description = $request->description;
        $solution->start_date = $request->start_date;
        $solution->end_date = $request->end_date;
        $solution->target = $request->target;
        $solution->notes = $request->notes;
        $solution->save();

        if ($solution) {
            return response()->json(['message' => 'Successfully Update Solution!'], 200);
        } else {
            return response()->json(['message' => 'Failed to Update Solution!']);
        }
    }

    public function destroy(int $id){
        $solution = IssueSolution::find($id);
        $solution->delete();

        return response()->json(['message' => 'Successfully Delete Solution!'], 200);
    }
}
