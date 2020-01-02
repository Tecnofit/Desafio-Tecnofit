<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Workout;
use App\Student;
use App\Exercice;
use App\Http\Controllers\API\API_WorkoutController;

class WorkoutController extends Controller
{
    public function __construct(API_WorkoutController $workoutService) 
    {
        $this->workoutService = $workoutService;
    }

    public function index()
    {
        $workouts = Workout::all();

        return response()->json($workouts);
    }

    public function show(int $id)
    {
        $workout = Workout::find($id);

        if ($workout)
        {
            return response()->json($workout);
        } else {
            return response()->json(
                ["error" => "Workout not found"]
            );
        }
    }
    
    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $this->studentService->store($request);

        return redirect("/students");
    }

    public function store(Request $request)
    {
        $workout = Workout::create($request->all());

        $exercices = $request->exercices;

        foreach($exercices as $exercice)
        {
            $workout->exercices()->attach($exercice['id_exercice'], ['series' => $exercice['series']]);
        }

        if ($request->active)
        {
            $student = Student::find($request->student_id);
            $deactivate_workout = Workout::find($student->active_workout);
            
            if ($deactivate_workout)
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
        
        $exercices = $request->exercices;

        foreach($exercices as $exercice)
        {
            $workout->exercices()->attach($exercice['id_exercice'], ['series' => $exercice['series']]);
        }

        if ($request->active)
        {
            $student = Student::find($workout->student_id);

            if ($student->active_workout != $workout->id)
            {
                $deactivate_workout = Workout::find($student->active_workout)->update(['active' => false]);
                $student->update(['active_workout' => $workout->id]);
            }
        }

        if ($request->done)
        {
            $student = Student::find($workout->student_id);

            if ($student->active_workout == $workout->id)
            {
                $student->update(['active_workout' => null]);
                $workout->update(['active' => false]);
            }
        }

        return response()->json($workout);
    }

    public function exercices(int $id)
    {
        $workout = Workout::find($id);

        return response()->json($workout->exercices);
    }

    public function destroy($id)
    {
        $workout = Workout::find($id);
        $workout->exercices()->detach();
        $workout = Workout::destroy($id);

        return response()->json($workout);
    }
}
