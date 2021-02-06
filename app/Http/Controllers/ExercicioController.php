<?php

namespace App\Http\Controllers;
use App\Models\ControllerExercicio;

use Illuminate\Http\Request;


class ExercicioController extends Controller
{
    public function __construct(ControllerExercicio $exercicio)
    {
        $this->exercicio = $exercicio;
    }
    
    public function index()
    {        
        return view('admin.pages.exercicio.index');
    }


    public function create()
    {       
        return view('admin.pages.exercicio.create');
    }

    public function show($id)
    {
        $data = $this->exercicio->find($id);
        return view('admin.pages.exercicio.show', compact('data'));
    }

    public function exercicioUpdate($id){        
        if (!$data = $this->exercicio->find($id)){
            return view('admin.pages.exercicio.update', compact('data')); 
        } else {
            return view('admin.pages.exercicio.update', compact('data'));
        }
    }
    
    public function updateExercicio(Request $request)
    {
        if (!$data = $this->exercicio->find($request->id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $this->validate($request, $this->exercicio->rules());
        
            $dataForm =  $request->all();

            $data->update($dataForm);
            
            return view('admin.pages.exercicio.index');
        }
    }
}
