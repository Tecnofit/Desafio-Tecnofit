<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Workout;


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

        if ($student)
        {
            return response()->json($student);
        } else {
            return response()->json(
                ["error" => "Student not found"]
            );
        }
    }
    
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        
        return response()->json($student);
    }

    public function update(Request $request, int $id)
    {
        $student = Student::find($id);

        if ($student)
        {
            $student->update($request->all());

            return response()->json($student);
        } else {
            return response()->json(
                ["error" => "Student not found"]
            );
        }
    }

    public function destroy(int $id)
    {
        $student = Student::find($id);

        if ($student)
        {
            $student->update(['active_workout' => null]);

            $workouts = $student->workouts;
    
            foreach($workouts as $workout)
            {
                $workout->exercises()->detach();
                Workout::destroy($workout->id);
            }
            
            $student = Student::destroy($id);
    
            return response()->json($student);
        } else {
            return response()->json(
                ["error" => "Student not found"]
            );
        }
    }

    public function workouts(int $id) 
    {
        $student = Student::find($id);

        if ($student) 
        {
            $workout = $student->workouts;
            
            return response()->json($workout);
        } else {
            return response()->json(
                ["error" => "Student not found"]
            );
        }
    }
}
