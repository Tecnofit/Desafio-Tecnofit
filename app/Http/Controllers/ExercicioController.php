<?php

namespace App\Http\Controllers;
use App\ExercicioModel;
use Illuminate\Http\Request;
use DB;
use Session;
class ExercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercicios = ExercicioModel::paginate(5);
        return view('exercicio/listaExercicio', compact('exercicios'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exercicio/createExercicio');
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
            'NOME_EXERCICIO' => 'required|min:3',
        ]);

        $exercicioModel = new ExercicioModel;
        $exercicioModel->NOME_EXERCICIO = $request->NOME_EXERCICIO;
        $exercicioModel->DESCRICAO_EXERCICIO = $request->DESCRICAO_EXERCICIO;
        $exercicioModel->save();
        Session::flash('ExercicioAdded', $exercicioModel->NOME_EXERCICIO.' adicionado com sucesso');

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
      //$exercicio = ExercicioModel::find($id);
        $exercicio = ExercicioModel::where('ID_EXERCICIO',$id)->first();
       return view('exercicio/editarExercicio', compact('exercicio'));
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
            'NOME_EXERCICIO' => 'required|min:3',
        ]);

        $exercicioModel = new ExercicioModel;
        DB::table('tb_exercicio')
        ->where('ID_EXERCICIO', $id)
        ->update(['NOME_EXERCICIO' => $request->NOME_EXERCICIO, 'DESCRICAO_EXERCICIO' => $request->DESCRICAO_EXERCICIO]);
        Session::flash('ExercicioUpdated', $request->NOME_EXERCICIO.' alterado(a) com sucesso');

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
         DB::table('tb_exercicio')
        ->where('ID_EXERCICIO', $id)
        ->delete();
        return back();
    }
}
