<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/tasks', 'TaskController@index')->middleware('auth')->middleware('cors');
Route::patch('/task/{task}','TaskController@update')->middleware('auth');
Route::delete('/task/{task}', 'TaskController@destroy')->middleware('auth');
Route::post('/task', 'TaskController@store')->middleware('auth');
