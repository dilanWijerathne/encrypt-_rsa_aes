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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);




Route::get('ntb', 'ntb@ntben');

Route::get('aes', 'ntb@aesEn');

Route::get('oben', 'ntb@obEn');

Route::get('aesde', 'ntb@aesDe');

Route::get('rsade', 'ntb@rsaDe');