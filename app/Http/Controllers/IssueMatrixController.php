<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueMatrix;
use Illuminate\Support\Facades\Validator;

class IssueMatrixController extends Controller
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
        $matrix = IssueMatrix::all();
        $matrix = array('data' => $matrix);
        return response()->json($matrix);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:issue_matrices',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $matrix = IssueMatrix::create([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        if ($matrix) {
            return response()->json(['message' => 'Successfully Create Matrix!']);
        } else {
            return response()->json(['message' => 'Failed to create Matrix!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $matrix)
    {
        $detail = IssueMatrix::where('id', $matrix)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $matrix)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $matrix = IssueMatrix::where('id', $matrix)->update([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        if ($matrix) {
            return response()->json(['message' => 'Successfully Update Matrix!']);
        } else {
            return response()->json(['message' => 'Failed to update Matrix!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $matrix)
    {
        $matrix = IssueMatrix::where('id', $matrix)->delete();
        if ($matrix) {
            return response()->json(['message' => 'Successfully Delete Matrix!']);
        } else {
            return response()->json(['message' => 'Failed to delete Matrix!']);
        }
    }
}
