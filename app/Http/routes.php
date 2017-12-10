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

Route::get('/', 'HomeController@getIndex');

Route::controller('home', 'HomeController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Route::group(['middleware' => ['web']], function () {
    
	Route::controller('login','Backend\LoginController');

	Route::get('admin-cp' , function(){
		return redirect('login');
	});

	if(\Request::segment(1) == trinata()->backendUrl)
	{
		include __DIR__.'/backendRoutes.php';
	}

// });

require 'apiRoutes.php';