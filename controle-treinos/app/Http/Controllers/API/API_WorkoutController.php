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

        // $exercises = Exercise::find($request->exercises);
        $exercises = $request->exercises;

        foreach($exercises as $exercise)
        {
            $workout->exercises()->attach($exercise['id_exercise'], ['series' => $exercise['series']]);
        }

        if($request->active)
        {
            $student = Student::find($request->student_id);
            $deactivate_workout = Workout::find($student->active_workout);
            
            if($deactivate_workout)
            {
                $deactivate_workout->update(['active' => false]);
            }
            
            $student->update(['active_workout' => $workout->id]);
        }
        
        return response()->json($workout);
    }

    public function update(Request $request, int $id)
    {
        $workout = Workout::find($id);
        $workout->update($request->all());
        
        $exercises = $request->exercises;

        foreach($exercises as $exercise)
        {
            $workout->exercises()->attach($exercise['id_exercise'], ['series' => $exercise['series']]);
        }

        if($request->active)
        {
            $student = Student::find($workout->student_id);

            if($student->active_workout != $workout->id)
            {
                $deactivate_workout = Workout::find($student->active_workout)->update(['active' => false]);
                $student->update(['active_workout' => $workout->id]);
            }
        }

        if($request->done)
        {
            $student = Student::find($workout->student_id);

            if($student->active_workout == $workout->id)
            {
                $student->update(['active_workout' => null]);
                $workout->update(['active' => false]);
            }
        }

        return response()->json($workout);
    }

    public function exercises(int $id)
    {
        $workout = Workout::find($id);

        return response()->json($workout->exercises);
    }

    public function destroy($id)
    {
        $workout = Workout::find($id);
        $workout->exercises()->detach();
        $workout = Workout::destroy($id);

        return response()->json($workout);
    }
}
