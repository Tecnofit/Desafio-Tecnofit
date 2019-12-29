<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exercise;

class API_ExerciseController extends Controller
  {
    public function index()
    {
        $exercises = Exercise::all();
        
        return response()->json($exercises);
    }

    public function show(int $id)
    {
        $exercise = Exercise::find($id);

        return response()->json($exercise);
    }
    
    public function store(Request $request)
    {
        $exercise = Exercise::create($request->all());
        
        return response()->json($exercise);
    }

    public function update(Request $request, int $id)
    {

        $exercise = Exercise::find($id)->update($request->all());

        return response()->json($exercise);
    }

    public function destroy($id)
    {
        $exercise = Exercise::destroy($id);

        return response()->json($exercise);
    }

    public function showEx(int $id)
    {
        $exercise = Exercise::find($id);

        return response()->json($exercise->workouts);
    }
}
