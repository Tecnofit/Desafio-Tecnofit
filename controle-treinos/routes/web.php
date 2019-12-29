<?php


Route::get('/', function () {
    return view('welcome');
});


Route::get('/alunos', 'AlunoController@index')
    ->name('show_alunos');
Route::get('/alunos/create', 'AlunoController@create')
    ->name('form_create_aluno');
Route::post('/alunos/create', 'AlunoController@store');
Route::delete('/alunos/{id}', 'AlunoController@destroy');

