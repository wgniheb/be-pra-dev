<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueSolution;
use App\Models\IssueImplementation;
use App\Models\ImplementationEvidance;
use Illuminate\Support\Facades\Validator;

class IssueImplementationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $id){
        $implementation = IssueImplementation::with('issueSolution')->with('implementationEvidances')->where('issue_id', $id)->get();

        return response()->json($implementation);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'issue_id' => 'required',
            'solution_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'date_implementation' => 'required',
            'evidance' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (count($value) < 1) {
                        $fail('The ' . $attribute . ' must have at least 2 items.');
                    }
                    foreach ($value as $item) {
                        if (!in_array($item->getClientOriginalExtension(), ['jpg', 'png', 'jpeg'])) {
                            $fail('The ' . $attribute . ' must be a file of type: jpg, png, jpeg.');
                        }
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $solution = IssueSolution::find($request->solution_id);

        if ($solution->start_date > $request->date_implementation || $solution->end_date < $request->date_implementation) {
            return response()->json(['message' => 'Implementation date must be between start date and end date of the solution'], 202);
        }

        $implementation = IssueImplementation::create([
            'issue_id' => $request->issue_id,
            'issue_solution_id' => $request->solution_id,
            'name' => $request->name,
            'description' => $request->description,
            'date_implementation' => $request->date_implementation,
        ]);

        foreach ($request->evidance as $file) {
            $fileName = 'evidance_implementation_'.time().uniqid().'.'.$file->extension();
            $path = public_path('evidances/'.$fileName);
            file_put_contents($path, $file->getContent());
            $implementation->implementationEvidances()->create([
                'evidance' => env('STORAGE_URL').'evidances/'.$fileName,
            ]);
        }

        if ($implementation) {
            return response()->json(['message' => 'Success Create Implementation'], 201);
        } else {
            return response()->json(['message' => 'Failed to create implementation'], 500);
        }
    }

    public function show(int $id)
    {
        $implementation = IssueImplementation::with('issueSolution')->with('implementationEvidances')->find($id);

        if ($implementation) {
            return response()->json($implementation);
        } else {
            return response()->json(['message' => 'Implementation not found'], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'required',
            'date_implementation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $implementation = IssueImplementation::find($id);  

        if ($implementation) {
            $solution = IssueSolution::find($implementation->issue_solution_id);

            if ($solution->start_date > $request->date_implementation || $solution->end_date < $request->date_implementation) {
                return response()->json(['message' => 'Implementation date must be between start date and end date of the solution'], 202);
            }

            if ($request->evidance){

                $implementation->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'date_implementation' => $request->date_implementation,
                ]);

                foreach ($implementation->implementationEvidances as $evidance) {
                    $evidance->delete();
                }

                foreach ($request->evidance as $file) {
                    $fileName = 'evidance_implementation_'.time().uniqid().'.'.$file->extension();
                    $path = public_path('evidances/'.$fileName);
                    file_put_contents($path, $file->getContent());
                    $implementation->implementationEvidances()->create([
                        'evidance' => env('STORAGE_URL').'evidances/'.$fileName,
                    ]);
                }
            }else{
                $implementation->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'date_implementation' => $request->date_implementation,
                ]);
            }

            return response()->json(['message' => 'Success Update Implementation'], 201);
        } else {
            return response()->json(['message' => 'Implementation not found'], 404);
        }
    }

    public function destroy(int $id)
    {
        $implementation = IssueImplementation::find($id);

        if ($implementation) {
            foreach ($implementation->implementationEvidances as $evidance) {
                $evidance->delete();
            }

            $implementation->delete();

            return response()->json(['message' => 'Success Delete Implementation'], 200);
        } else {
            return response()->json(['message' => 'Implementation not found'], 404);
        }
    }
}
