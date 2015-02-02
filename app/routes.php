<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::post('api/v1/users', 'UsersController@store');

Route::group(array('prefix' => 'api/v1'), function()
{
  Route::resource('users', 'UsersController');
  Route::resource('churches', 'ChurchesController');
  Route::resource('targets', 'TargetsController');
  Route::resource('actions', 'ActionsController');
  Route::resource('settings', 'SettingsController');
  Route::controller('map', 'MapController');
});


