<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

  return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home.index');

### ALUNO ###
Route::get('/aluno', 'AlunoController@index')->name('aluno.index');
Route::resource('/aluno', 'AlunoController');
Route::get('/AlunoUpdate/{id}', 'AlunoController@alunoUpdate');
Route::get('/updateAluno', 'AlunoController@updateAluno');

### EXERCICIO ###
Route::get('/exercicio', 'ExercicioController@index')->name('exercicio.index');
Route::resource('/exercicio', 'ExercicioController');
Route::get('/exercicioUpdate/{id}', 'ExercicioController@exercicioUpdate');
Route::get('/updateExercicio', 'ExercicioController@updateExercicio');

### TREINO ###
Route::get('/treino', 'TreinoController@index')->name('treino.index');
Route::resource('/treino', 'TreinoController');
Route::get('/treinoUpdate/{id}', 'TreinoController@treinoUpdate');
Route::get('/updateTreino', 'TreinoController@updateTreino');

