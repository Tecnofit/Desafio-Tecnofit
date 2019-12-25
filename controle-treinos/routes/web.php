<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alunos', 'AlunoController@index')
    ->name('show_alunos');
Route::get('/alunos/create', 'AlunoController@create')
    ->name('form_create_aluno');
Route::post('/alunos', 'AlunoController@store');
Route::delete('/alunos/{id}', 'AlunoController@destroy');

