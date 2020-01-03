<?php

namespace App\Http\Controllers;
use App\alunoModel;
use App\TreinoModel;
use Illuminate\Http\Request;
use DB;
use Session;
class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Função para passar os dados de alunos e treinos, também faz a paginação.
       $alunos = AlunoModel::paginate(5);
       $treinos = TreinoModel::all();
       return view('aluno/listaAluno', compact('alunos', 'treinos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aluno/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'NOME' => 'required|min:3',
            'CPF' => 'required|min:14|max:14',
            'DATA_NASCIMENTO' => 'required',
        ]);

        $alunoModel = new AlunoModel;
        $alunoModel->NOME = $request->NOME;
        $alunoModel->CPF = $request->CPF;
        $alunoModel->DATA_NASCIMENTO = $request->DATA_NASCIMENTO;
        $alunoModel->SEXO = $request->SEXO;
        $alunoModel->OBS = $request->OBS;
        $alunoModel->save();
        Session::flash('AlunoAdded', $alunoModel->NOME.' adicionado(a) com sucesso');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = AlunoModel::find($id);
        $treinos = TreinoModel::all();
       return view('aluno/visualizarAluno', compact('aluno', 'treinos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $aluno = AlunoModel::find($id);
       return view('aluno/editarAluno', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'NOME' => 'required|min:3',
            'CPF' => 'required|min:14|max:14',
        ]);

        $alunoModel = new AlunoModel;
        DB::table('tb_aluno')
        ->where('ID', $id)
        ->update(['NOME' => $request->NOME, 'CPF' => $request->CPF, 'DATA_NASCIMENTO' => $request->DATA_NASCIMENTO, 'SEXO' => $request->SEXO, 'OBS' => $request->OBS]);
        Session::flash('AlunoUpdated', $request->NOME.' alterado(a) com sucesso');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tb_aluno')
        ->where('ID', $id)
        ->delete();
        return back();
    }
}
