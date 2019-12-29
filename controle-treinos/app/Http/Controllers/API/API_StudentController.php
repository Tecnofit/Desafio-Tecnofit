<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;

class API_StudentController extends Controller
  {
    public function index() 
    {
        $students = Student::all();

        return response()->json($students);
    }

    public function show(int $id)
    {
        $student = Student::find($id);

        return response()->json($student);
    }
    
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        
        return response()->json($student);
    }

    public function update(Request $request, int $id)
    {

        $student = Student::find($id)->update($request->all());

        return response()->json($student);
    }

    public function destroy(int $id)
    {
        $student = Student::destroy($id);

        return response()->json($student);
    }

    public function active_workout(int $id)
    {
        $workout = Student::find($id)->active_workout;

        return response()->json($workout);
    }

    public function workouts(int $studentId) 
    {
        $student = Student::find($studentId);
        $workout = $student->workouts;
        
        return response()->json($workout);
    }
}
