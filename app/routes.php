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

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('appointment', 'Appointment');
Route::model('user', 'User');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('appointment', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');


/*
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');
//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');
# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');
*/


// Control Panel
Route::group(array('prefix' => 'home', 'before' => 'auth'), function()
{

	// Appointment Management
	Route::get('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentsController@create'));
	Route::post('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentsController@create'));
	Route::get('appointment/{appointment}/show', array('as' => 'appointment.show', 'uses' => 'AppointmentsController@show'));
	Route::get('appointment/show-all', array('as' => 'appointment.show.all', 'uses' => 'AppointmentsController@showAll'));
	Route::get('appointment/show-all/{requestID}', array('as' => 'appointment.show.all.id', 'uses' => 'AppointmentsController@showAll'));
	//Route::get('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentsController@edit'));
	Route::post('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentsController@edit'));
	Route::get('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentsController@changeStatus'));
	Route::post('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentsController@changeStatus'));
	
	// Patient Management
	Route::get('patient/create', array('as' => 'patient.create', 'uses' => 'PatientController@create'));
	Route::post('patient/create', array('as' => 'patient.create', 'uses' => 'PatientController@create'));
	Route::get('patient/show-all', array('as' => 'patient.show.all', 'uses' => 'PatientController@showAll'));
	
	Route::get('/', array('as' => 'home.index', 'uses' => 'HomeController@getIndex'));
    


});


Route::any('/', 'SiteController@getIndex');



// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

