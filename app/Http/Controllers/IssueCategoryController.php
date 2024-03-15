<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueCategory;
use Illuminate\Support\Facades\Validator;

class IssueCategoryController extends Controller
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
        $category = IssueCategory::all('id', 'name', 'description');
        $category = array('data' => $category);
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|unique:issue_categories',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $category = IssueCategory::create([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        if ($category) {
            return response()->json(['message' => 'Successfully Create Category!']);
        } else {
            return response()->json(['message' => 'Failed to create Category!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $category)
    {
        $detail = IssueCategory::where('id', $category)->first();
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $category)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $category = IssueCategory::where('id', $category)->first();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        if ($category) {
            return response()->json(['message' => 'Successfully Update Category!']);
        } else {
            return response()->json(['message' => 'Failed to update Category!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $category)
    {
        $category = IssueCategory::where('id', $category)->first();
        $category->delete();

        if ($category) {
            return response()->json(['message' => 'Successfully Delete Category!']);
        } else {
            return response()->json(['message' => 'Failed to delete Category!']);
        }
    }
}
