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

Route::get('/', function() {
    return response()->json();
});

Route::get('/students', 'API\API_StudentController@index');
Route::get('/students/{id}', 'API\API_StudentController@show');
Route::get('/students/{id}/workouts', 'API\API_StudentController@workouts');
Route::post('/students/create', 'API\API_StudentController@store');
Route::put('/students/{id}', 'API\API_StudentController@update');
Route::delete('/students/{id}', 'API\API_StudentController@destroy');


Route::get('/workouts', 'API\API_WorkoutController@index');
Route::get('/workouts/{id}', 'API\API_WorkoutController@show');
Route::post('/workouts/create', 'API\API_WorkoutController@store');
Route::put('/workouts/{id}', 'API\API_WorkoutController@update');
Route::delete('/workouts/{id}', 'API\API_WorkoutController@destroy');
Route::get('/workouts/{id}/exercices', 'API\API_WorkoutController@exercices');


Route::get('/exercices', 'API\API_ExerciceController@index');
Route::get('/exercices/{id}', 'API\API_ExerciceController@show');
Route::get('/exercices/{id}/workouts', 'API\API_ExerciceController@showEx');
Route::post('/exercices/create', 'API\API_ExerciceController@store');
Route::put('/exercices/{id}', 'API\API_ExerciceController@update');
Route::delete('/exercices/{id}', 'API\API_ExerciceController@destroy');