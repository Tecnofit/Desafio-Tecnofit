<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exercice;

class API_ExerciceController extends Controller
{
    public function getExercices()
    {
        return Exercice::all();
    }

    public function index()
    {
        $exercices = Exercice::all();
        
        return response()->json($this->getExercices());
    }

    public function show(int $id)
    {
        $exercice = Exercice::find($id);

        if ($exercice) {
            return response()->json($exercice);
        } else {
            return response()->json(
                ["error" => "Exercice not found"]
            );
            
        }
    }
    
    public function store(Request $request)
    {
        if (!$request->name) 
        {
            return response()->json(
                ["error" => "Property 'name' not found"]
            );
        } else {
            $exercice = Exercice::create($request->all());
            
            return response()->json($exercice);
        }
    }

    public function update(Request $request, int $id)
    {

        $exercice = Exercice::find($id);
        
        if ($exercice)
        {
            $exercice->update($request->all());
        
            return response()->json($exercice);
        } else {
            return response()->json(
                ["error" => "Exercice not found"]
            );
        }

    }

    public function destroy($id)
    {
        $exercice = Exercice::find($id);

        if ($exercice) {
            $workouts = $exercice->workouts;
    
            foreach($workouts as $workout)
            {
                if($workout->active == true)
                {
                    return response()->json(
                        ["error" => "Exercício em treino ativo"]
                    );
                }
            }
    
            foreach($workouts as $workout)
            {
                $workout->exercices()->detach();
            }
    
            $exercice = Exercice::destroy($id);
    
            return response()->json($exercice);
        } else {
            return response()->json(
                ["error" => "Exercice not found"]
            );
        }
    }

    public function showEx(int $id)
    {
        $exercice = Exercice::find($id);

        return response()->json($exercice->workouts);
    }
}
