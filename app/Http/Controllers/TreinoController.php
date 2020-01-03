<?php

namespace App\Http\Controllers;
use App\alunoModel;
use App\TreinoModel;
use App\ExercicioModel;
use Illuminate\Http\Request;
use DB;
use Session;
class TreinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //Função que leva exercicios e aluno(id) para fazer o vinculo, falta arrumar
        $aluno = new AlunoModel;
        $aluno = AlunoModel::find($id);
        $exercicios = new ExercicioModel;
        $exercicios = ExercicioModel::all();
        return view('treino/create', compact('exercicios','aluno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validadores, aprender a alterar a mensagem
        $this->validate($request, [
            'NOME_FICHA' => 'required|min:3',
            'NOME_FICHA' => 'required',
            'EXERCICIO_UM'=> 'required',
            'EXERCICIO_UM_QTD_SESSAO' => 'required',
            'EXERCICIO_DOIS'=> 'required',
            'EXERCICIO_DOIS_QTD_SESSAO'=> 'required',
            'EXERCICIO_TRES'=> 'required',
            'EXERCICIO_TRES_QTD_SESSAO' => 'required',
            'EXERCICIO_QUATRO'=> 'required',
            'EXERCICIO_QUATRO_QTD_SESSAO'=> 'required', 
        ]);

        //Passar dados para as variaveis
        $treinoModel = new TreinoModel;
        $treinoModel->NOME_FICHA = $request->NOME_FICHA;
        $treinoModel->EXERCICIO_UM = $request->EXERCICIO_UM;
        $treinoModel->EXERCICIO_UM_QTD_SESSAO = $request->EXERCICIO_UM_QTD_SESSAO;
        $treinoModel->EXERCICIO_DOIS = $request->EXERCICIO_DOIS;
        $treinoModel->EXERCICIO_DOIS_QTD_SESSAO = $request->EXERCICIO_DOIS_QTD_SESSAO;
        $treinoModel->EXERCICIO_TRES = $request->EXERCICIO_TRES;
        $treinoModel->EXERCICIO_TRES_QTD_SESSAO = $request->EXERCICIO_TRES_QTD_SESSAO;
        $treinoModel->EXERCICIO_QUATRO = $request->EXERCICIO_QUATRO;
        $treinoModel->EXERCICIO_QUATRO_QTD_SESSAO = $request->EXERCICIO_QUATRO_QTD_SESSAO;
        $treinoModel->STATUS = $request->STATUS;
        $treinoModel->ID_ALUNO_FICHA = $request->ID_ALUNO_FICHA;
        //Salvando no banco de dados
        $treinoModel->save();
        //Session para passar mensagem de sucesso
        Session::flash('TreinoAdded','Treino adicionado com sucesso');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
