<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('recipes/photos', 'RecipesController@saveImage');

Auth::routes();

// auth routes
Route::group(['middleware' => 'auth'], function () {
	// all recipe routes
    Route::resource('recipes', 'RecipesController');
});