<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $students = Student::get();
          return response()->json( [
               "status"=> "success",
                "data" => $students
                
          ], status :200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:students,email',
        'gender' => 'required|in:male,female',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'fail',
            'message' => $validator->errors()
        ], 400);
    }

    $student = Student::create($validator->validated());

    return response()->json([
        'status'  => 'success',
        'message' => 'Student created successfully',
        'data'    => $student
    ], 201);
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = student::find($id);

        if($student){
            return response()->json([
           'status' => "success",
            "data" => $student
            ], 200);
        }

        return response()->json([
            'status' => 'fail',
            'message' => 'No student found'
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    $student = Student::find($id);

    if (!$student) {
        return response()->json([
            'status' => 'fail',
            'message' => 'No Student found for this request'
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:students,email,' . $id,
        'gender' => 'required|in:male,female',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'fail',
            'message' => $validator->errors()
        ], 400);
    }

    $student->name = $request->input('name');
    $student->email = $request->input('email');
    $student->gender = $request->input('gender');
    $student->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Student data updated successfully',
        'data' => $student
    ], 200);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = student::find($id);

        if (!$student) {
        return response()->json([
            'status' => 'fail',
            'message' => 'No Student found for this request'
        ], 404);
    }
     $student->delete();
     
     return response()->json([
        'status' => 'success',
        'message' => 'Student data deleted successfully',
       
    ], 200);
    }
}

