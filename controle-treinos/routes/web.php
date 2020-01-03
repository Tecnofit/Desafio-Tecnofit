<?php


Route::get('/', function () {
    return view('welcome');
});


Route::get('/students', 'Application\StudentController@index')->name('show_students');
Route::get('/students/create', 'Application\StudentController@create')->name('form_create_student');
Route::get('/students/{id}', 'Application\StudentController@show');
Route::post('/students/create', 'Application\StudentController@store');
Route::put('/students/{id}', 'Application\StudentController@update')->name('update_student');
Route::delete('/students/{id}', 'Application\StudentController@destroy');
Route::get('/studentsn/{id}', 'Application\StudentController@workouts');


Route::get('/exercices', 'Application\ExerciceController@index')->name('show_exercices');
Route::get('/exercices/create', 'Application\ExerciceController@create')->name('form_create_exercice');
Route::get('/exercices/{id}', 'Application\ExerciceController@show');
Route::post('/exercices/create', 'Application\ExerciceController@store');
Route::put('/exercices/{id}', 'Application\ExerciceController@update');
Route::delete('/exercices/{id}', 'Application\ExerciceController@destroy');


// Route::get('/workouts', 'API\API_WorkoutController@index'); //remover rota
Route::get('/workouts/{id}', 'Application\WorkoutController@show');
Route::get('/workouts/{id}/create', 'Application\WorkoutController@create')->name('form_create_workout');
Route::post('/workouts/{id}/create', 'Application\WorkoutController@store');
Route::put('/workouts/{id}', 'Application\WorkoutController@update');
// Route::delete('/workouts/{id}', 'API\API_WorkoutController@destroy');
// Route::get('/workouts/{id}/exercices', 'API\API_WorkoutController@exercices'); //remover rota

// protected $fillable = ['name', 'description', 'student_id', 'active', 'done'];