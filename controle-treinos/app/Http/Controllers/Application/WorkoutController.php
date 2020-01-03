<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use Collective\Html\FormFacade;
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
        $getExerciceId = function($exercice) {
            return $exercice->id;
        };

        $workout = $this->workoutService->show($id)->getData();
        $student = Student::find($workout->student_id);
        $exercices_options = Exercice::all();
        $exercices_active = $this->workoutService->exercices($id)->getData();
        $exercices_active_ids = array_map($getExerciceId, $exercices_active);

        // var_dump($exercices_active);
        // echo $exercices_active;

        return view('workouts.show', compact('workout', 'student', 'exercices_options', 'exercices_active', 'exercices_active_ids'));
    }
    
    public function create(int $student_id)
    {
        $student = Student::find($student_id);

        $exercices_options = Exercice::all();
        return view('workouts.create', compact('student', 'exercices_options'));
    }

    public function store(Request $request)
    {
        $exercices = array();

        foreach($request->exercices_select as $key=>$value)
        {
            array_push($exercices, array(
                "id_exercice" => $value,
                "series" => $request->series[$key]
            ));
        }

        $request->merge(['exercices' => $exercices]);

        $this->workoutService->store($request);

        return redirect("/students"); 
    }

    public function update(Request $request, int $id)
    {
        $exercices = array();

        foreach($request->exercices_select as $key=>$value)
        {
            array_push($exercices, array(
                "id_exercice" => $value,
                "series" => $request->series[$key]
            ));
        }

        $request->merge(['exercices' => $exercices]);

        $this->workoutService->update($request, $id);
        
        return redirect("/students");
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
