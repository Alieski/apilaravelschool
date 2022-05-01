<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::get('students', 'App\Http\Controllers\StudentController@index');
Route::get('students/{student}', 'App\Http\Controllers\StudentController@show');
Route::post('students', 'App\Http\Controllers\StudentController@store');
Route::put('students/{student}', 'App\Http\Controllers\StudentController@update');
Route::delete('students/{student}', 'App\Http\Controllers\StudentController@delete');
*/

Route::resource('class', 'App\Http\Controllers\KlassController');
Route::resource('student', 'App\Http\Controllers\StudentController');
Route::resource('conference', 'App\Http\Controllers\ConferenceController');
Route::resource('plan', 'App\Http\Controllers\PlanController');
/*
Route::get('classes/{class}', 'App\Http\Controllers\KlassController@show');
Route::post('classes', 'App\Http\Controllers\KlassController@store');
Route::patch('classes/{class}', 'App\Http\Controllers\KlassController@update');
Route::delete('classes/{class}', 'App\Http\Controllers\KlassController@delete');
*/
/*
Route::get('conferences', 'App\Http\Controllers\KlassController@index');
Route::get('conferences/{conference}', 'App\Http\Controllers\KlassController@show');
Route::post('conferences', 'App\Http\Controllers\KlassController@store');
Route::put('conferences/{conference}', 'App\Http\Controllers\KlassController@update');
Route::delete('conferences/{conferences}', 'App\Http\Controllers\KlassController@delete');
*/