<?php

use Illuminate\Http\Request;

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


Route::get('/students', 'API\API_StudentController@index');
Route::get('/students/{id}', 'API\API_StudentController@show');
Route::get('/students/{id}/workouts', 'API\API_StudentController@workouts');
Route::post('/students/create', 'API\API_StudentController@store');
Route::put('/students/{id}', 'API\API_StudentController@update');
Route::delete('/students/{id}', 'API\API_StudentController@destroy');


Route::get('/workouts', 'API\API_WorkoutController@index'); //remover rota
Route::get('/workouts/{id}', 'API\API_WorkoutController@show');
Route::post('/workouts/create', 'API\API_WorkoutController@store');
Route::put('/workouts/{id}', 'API\API_WorkoutController@update');
Route::delete('/workouts/{id}', 'API\API_WorkoutController@destroy');
Route::get('/workouts/{id}/exercises', 'API\API_WorkoutController@exercises'); //remover rota


Route::get('/exercises', 'API\API_ExerciseController@index');
Route::get('/exercises/{id}', 'API\API_ExerciseController@show');
Route::get('/exercises/{id}/workouts', 'API\API_ExerciseController@showEx'); //remover rota
Route::post('/exercises/create', 'API\API_ExerciseController@store');
Route::put('/exercises/{id}', 'API\API_ExerciseController@update');
Route::delete('/exercises/{id}', 'API\API_ExerciseController@destroy');