<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ControllerTreino;
use App\Models\ControllerExercicio;
use App\Models\ControllerAluno;

class TreinoApiController extends Controller
{
    public function __construct(ControllerTreino $treino,
                                ControllerExercicio $exercicio,
                                ControllerAluno $aluno,
                                Request $Request)
    {
        $this->treino = $treino;
        $this->exercicio = $exercicio;
        $this->aluno = $aluno;
        $this->request = $Request;
    }


    public function index()
    {
        $data = ControllerTreino::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $dataForm =  $request->all();
        
        foreach ($request["dados"] as $value) {
            
            $dataForm["id_aluno"] = $value["id_aluno"];
            $dataForm["id_exercicio"] = $value["id_exercicio"];
            $dataForm["sessao"] = $value["sessao"];
            $dataForm["status"] = $value["status"];
            $dataForm["ativo"] = 0;
            
            $data = $this->treino->create($dataForm);
        }
        
        return response()->json($data, 200);
    }

    public function show($id)
    {
        if (!$data = $this->treino->find($id)) {
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            return response()->json($data);
        }
    }

    public function update(Request $request, $id)
    {
        if (!$data = $this->treino->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $this->validate($request, $this->treino->rules());
        
            $dataForm =  $request->all();

            $data->update($dataForm);
            
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        if (!$data = $this->treino->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $data->delete();

            return response()->json(['success'=> 'Deletado com Sucesso']);
        }
    }

    public function AlunoExercicio($id) 
    {
        if (!$data = $this->treino::where('id_aluno', $id)->get(['id', 'id_aluno', 'id_exercicio', 'status','sessao','created_at'])) {
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {            
            $dataExerciciosAluno =  $this->getExerciciosAluno($data);
            return response()->json($dataExerciciosAluno);
        }
    }

    public function getExerciciosAluno($array)
    {
        $arrayExerciciosAluno = [];
        
        foreach ($array as $key => &$val) {            
            $arrayExerciciosAluno[$key]['id_exercicio'] = $val['id_exercicio'];
            $exercicio = $this->exercicio::where('id', $val['id_exercicio'])->get(['nome']);            
            $arrayExerciciosAluno[$key]['nome'] = $exercicio[0]['nome'];
            $arrayExerciciosAluno[$key]['status'] = $val['status'];
            $arrayExerciciosAluno[$key]['ativo'] = $val['ativo'];
            $arrayExerciciosAluno[$key]['sessao'] = $val['sessao'];
        }
        return $arrayExerciciosAluno;
    }

    public function AtivaTreino(Request $request, $id)
    {   
        if (!$data = $this->aluno->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {            
            
            $dataTreino = $this->treino::where('id_aluno', $data['id'])->get(['ativo']);          
            $status = ($dataTreino[0]['ativo'] == 0) ? 1 : 0;            
            $dataResult = $this->treino::where('id_aluno', $data['id'])->update(['ativo' => $status]);
        
          return response()->json($dataResult);
        }
      
    }

    public function PularExercicio(Request $request, $id)
    {   
        if (!$data = $this->aluno->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $dataForm =  $request->all();
            $dataTreino = $this->treino::where('id_aluno', $data['id'])->get(['status']);
            $dataResult = $this->treino::where('id_aluno', $data['id'])
            ->where('id_exercicio', $dataForm['id_exercicio'])
            ->update(['status' => 2]);
            
            return response()->json($dataResult);
          
        }
    }

    public function FinalizarExercicio(Request $request, $id)
    {   
        if (!$data = $this->aluno->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $dataForm =  $request->all();
            $dataTreino = $this->treino::where('id_aluno', $data['id'])->get(['status']);
            $dataResult = $this->treino::where('id_aluno', $data['id'])
            ->where('id_exercicio', $dataForm['id_exercicio'])
            ->update(['status' => 1]);
            
            return response()->json($dataResult);
          
        }
    }

    public function verficaExercicio(Request $request, $id)
    {
        if (!$dataTreino = $this->treino::where('id_exercicio', $id)->get(['ativo'])){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            if (empty($dataTreino[0]["ativo"])) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
           
        }
    }
}
