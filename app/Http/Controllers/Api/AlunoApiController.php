<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ControllerAluno;
use App\Models\ControllerTreino;

class AlunoApiController extends Controller
{
    public function __construct(ControllerAluno $aluno,
                                ControllerTreino $treino,
                                Request $Request)
    {
        $this->aluno = $aluno;
        $this->treino = $treino;
        $this->request = $Request;
    }

    public function getTreino($id_aluno) {
        $dataTreino = $this->treino::where('id_aluno', $id_aluno)->take(1)->get(['status','sessao','ativo']);
        return $dataTreino;
    }

    public function index()
    {
        $arrayAlunoTreino = [];
        $data = ControllerAluno::all();
        foreach ($data as $key => &$val) { 
            $arrayAlunoTreino[$key]['id'] = $val['id'];
            $arrayAlunoTreino[$key]['nome'] = $val['nome'];
            $arrayAlunoTreino[$key]['email'] = $val['email'];
            $dataTreino = $this->treino::where('id_aluno', $val['id'])->get(['*']);            
            if (empty($dataTreino[0]) == 0) {
                $arrayAlunoTreino[$key]['status'] = $dataTreino[0]['status'];
                $arrayAlunoTreino[$key]['ativo'] = $dataTreino[0]['ativo'];
            } else {
                $arrayAlunoTreino[$key]['status'] = 0;
                $arrayAlunoTreino[$key]['ativo'] = 0;
            }        
            $arrayAlunoTreino[$key]['created_at'] = $val['created_at'];
            $arrayAlunoTreino[$key]['updated_at'] = $val['updated_at'];
        }
        return response()->json($arrayAlunoTreino);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->aluno->rules());
        
        $dataForm =  $request->all();

        $data = $this->aluno->create($dataForm);
        
        return response()->json($data, 200);
    }

    public function show($id)
    {
        if (!$data = $this->aluno->find($id)) {
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {           
            return response()->json($data);
        }
    }

    public function update(Request $request, $id)
    {
        if (!$data = $this->aluno->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $this->validate($request, $this->aluno->rules());
        
            $dataForm =  $request->all();

            $data->update($dataForm);
            
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        if (!$data = $this->aluno->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $data->delete();

            return response()->json(['success'=> 'Deletado com Sucesso']);
        }
    }
}
