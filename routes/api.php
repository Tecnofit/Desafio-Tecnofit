<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function (){
    Route::apiResource('Aluno', 'AlunoApiController');
    Route::apiResource('Exercicio', 'ExercicioApiController');
    Route::apiResource('Treino', 'TreinoApiController');

    Route::get('AlunoExercicio/{id}', 'TreinoApiController@AlunoExercicio');
    Route::get('AtivaTreino/{id}', 'TreinoApiController@AtivaTreino');
    Route::get('PularExercicio/{id}', 'TreinoApiController@PularExercicio');
    Route::get('FinalizarExercicio/{id}', 'TreinoApiController@FinalizarExercicio');
    Route::get('verficaExercicio/{id}', 'TreinoApiController@verficaExercicio');
    
});