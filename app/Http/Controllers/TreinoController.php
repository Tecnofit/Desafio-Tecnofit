<?php

namespace App\Http\Controllers;
use App\Models\ControllerTreino;
use App\Models\ControllerAluno;
use App\Models\ControllerExercicio;

use Illuminate\Http\Request;


class TreinoController extends Controller
{
    public function __construct(ControllerTreino $treino)
    {
        $this->treino = $treino;
    }
    
    public function index()
    {        
        $dados['status'] = $this->validTreino();
        return view('admin.pages.treino.index', compact('dados'));
    }

    public function validTreino() 
    {
        $dados['aluno'] = ControllerAluno::all();
        $dados['exercicio'] = ControllerExercicio::all();

        $qtdAluno = (isset($dados['aluno'])) ? 1 : 0;
        $qtdExercicio = (isset($dados['exercicio'])) ? 1 : 0;

        if (($qtdAluno == 0) &&
            ($qtdExercicio == 0)) {            
            return 0;
        } else {            
            return 1;
        }
    }

    public function create()
    {
        if ($this->validTreino() == 1) {
            $dados['aluno'] = ControllerAluno::all();
            $dados['exercicio'] = ControllerExercicio::all();
            $dados['status'] = 1;
            return view('admin.pages.treino.create', compact('dados'));
        } else {
            $dados['status'] = 0;
            return view('admin.pages.treino.index', compact('dados'));
            
        }
        
    }

    public function show($id)
    {
        $data = $this->treino->find($id);
        return view('admin.pages.treino.show', compact('data'));
    }

    public function treinoUpdate($id){        
        if (!$data = $this->treino->find($id)){
            return view('admin.pages.treino.update', compact('data')); 
        } else {
            return view('admin.pages.treino.update', compact('data'));
        }
    }
    
    public function updateTreino(Request $request)
    {
        if (!$data = $this->treino->find($request->id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $this->validate($request, $this->treino->rules());
        
            $dataForm =  $request->all();

            $data->update($dataForm);
            
            return view('admin.pages.treino.index');
        }
    }
}
