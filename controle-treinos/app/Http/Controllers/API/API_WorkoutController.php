<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Workout;
use App\Student;
use App\Exercise;

class API_WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::all();

        return response()->json($workouts);
    }

    public function show(int $id)
    {
        $workout = Workout::find($id);

        return response()->json($workout);
    }
    
    public function store(Request $request)
    {
        $workout = Workout::create($request->all());

        if($request->active)
        {
            $student = Student::find($request->student_id);
            $deactivate_workout = Workout::find($student->active_workout)->update(['active' => false]);

            $student->update(['active_workout' => $workout->id]);
        }
        
        return response()->json($workout);
    }

    public function update(Request $request, int $id)
    {
        $workout = Workout::find($id);
        $workout->update($request->all());

        if($request->active)
        {
            $student = Student::find($workout->student_id);

            if($student->active_workout != $workout->id)
            {
                $deactivate_workout = Workout::find($student->active_workout)->update(['active' => false]);
                $student->update(['active_workout' => $workout->id]);
            }
        }

        return response()->json($workout);
    }

    public function exercises(Request $request, int $id)
    {
        $workout = Workout::find($id);
        $exercises = Exercise::find($request->exercises);
        $workout->exercises()->attach($exercises);

        return response()->json($workout);
    }

    public function destroy($id)
    {
        $workout = Workout::destroy($id);

        return response()->json($workout);
    }
}
