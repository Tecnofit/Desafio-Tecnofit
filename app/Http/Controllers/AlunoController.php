<?php

namespace App\Http\Controllers;
use App\Models\ControllerAluno;
use App\Models\ControllerTreino;
use App\Models\ControllerExercicio;

use Illuminate\Http\Request;


class AlunoController extends Controller
{
    public function __construct(ControllerAluno $aluno,
                                ControllerTreino $treino,
                                ControllerExercicio $exercicio)
    {
        $this->aluno = $aluno;
        $this->treino = $treino;
        $this->exercicio = $exercicio;
    }
    
    public function index()
    {        
        return view('admin.pages.aluno.index');
    }


    public function create()
    {       
        return view('admin.pages.aluno.create');
    }

    public function show($id)
    {
        $data['aluno'] = $this->aluno->find($id);
        $treino = $this->treino::where('id_aluno', $data['aluno']['id'])->get(['status','id_exercicio', 'sessao', 'ativo']);
        if (empty($treino[0]) == 0) {            
            foreach ($treino as $key => &$val) {
                $arrayExercicio[$key]['id_exercicio'] = $val['id_exercicio'];
                $dataExercicio = $this->exercicio::where('id', $val['id_exercicio'])->get(['nome','status']);
                $arrayExercicio[$key]['nome'] = $dataExercicio[0]['nome'];
                $arrayExercicio[$key]['status'] = $val['status'];
            }
            $data['treino'] = $treino[0]['ativo'];
        } else {
            $arrayExercicio[0]['id_exercicio'] = 0;            
            $arrayExercicio[0]['nome'] = 'Treino não vinculado';
            $arrayExercicio[0]['status'] = 0;
            $data['treino'] = 0;
        }
        return view('admin.pages.aluno.show', compact('data','arrayExercicio'));
    }

    public function alunoUpdate($id){
        if (!$data = $this->aluno->find($id)){
            return view('admin.pages.aluno.update', compact('data')); 
        } else {
            return view('admin.pages.aluno.update', compact('data'));
        }
    }
    
    public function updateAluno(Request $request)
    {
        if (!$data = $this->aluno->find($request->id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $this->validate($request, $this->aluno->rules());
        
            $dataForm =  $request->all();

            $data->update($dataForm);
            
            return view('admin.pages.aluno.index');
        }
    }
}
