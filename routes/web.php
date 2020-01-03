<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rotas relacionadas a alunos
Route::get('aluno/create', 'AlunoController@create');
Route::post('aluno/store', 'AlunoController@store');
Route::get('aluno/listaAluno', 'AlunoController@index');
Route::get('aluno/editarAluno/{ID}', 'AlunoController@edit');
Route::post('aluno/update/{ID}', 'AlunoController@update');
Route::delete('aluno/delete/{ID}', 'AlunoController@destroy');
Route::get('/aluno/visualizarAluno/{ID}', 'AlunoController@show');

//Rotas relacionadas a exercicios
Route::get('exercicio/createExercicio', 'ExercicioController@create');
Route::post('exercicio/store', 'ExercicioController@store');
Route::get('exercicio/listaExercicio', 'ExercicioController@index');
Route::get('exercicio/editarExercicio/{ID_EXERCICIO}', 'ExercicioController@edit');
Route::post('exercicio/update/{ID_EXERCICIO}', 'ExercicioController@update');
Route::delete('exercicio/delete/{ID_EXERCICIO}', 'ExercicioController@destroy');

//Rotas relacionadas ao treino do aluno
Route::get('treino/create/{ID}', 'TreinoController@create');
Route::post('treino/store', 'TreinoController@store');

