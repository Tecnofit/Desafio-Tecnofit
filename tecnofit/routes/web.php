<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@authenticate');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/customers', 'CustomerController');
    Route::resource('/exercises', 'ExerciseController');
    Route::resource('/trainings', 'TrainingController');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
