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
Route::model('conversation', 'Conversation');
Route::model('user', 'User');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('appointment', '[0-9]+');
Route::pattern('conversation', '[0-9]+');
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
	Route::get('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentController@create'));
	Route::post('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentController@create'));
	Route::get('appointment/{appointment}/show', array('as' => 'appointment.show', 'uses' => 'AppointmentController@show'));
	Route::get('appointment/show-all', array('as' => 'appointment.show.all', 'uses' => 'AppointmentController@showAll'));
	Route::get('appointment/show-all/{requestID}', array('as' => 'appointment.show.all.id', 'uses' => 'AppointmentController@showAll'));
	//Route::get('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentController@edit'));
	Route::post('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentController@edit'));
	Route::get('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentController@changeStatus'));
	Route::post('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentController@changeStatus'));

	// Conversation Management
	Route::get('conversation/create', array('as' => 'conversation.create', 'uses' => 'ConversationController@create'));
	Route::get('conversation/{user}/create', array('as' => 'conversation.recipient.create', 'uses' => 'ConversationController@create'));
	Route::post('conversation/create', array('as' => 'conversation.create', 'uses' => 'ConversationController@create'));
	//Route::get('conversation/edit', array('as' => 'conversation.edit', 'uses' => 'ConversationController@edit'));
	//Route::post('conversation/edit', array('as' => 'conversation.edit', 'uses' => 'ConversationController@edit'));
	Route::get('conversation/{conversation}/show', array('as' => 'conversation.show', 'uses' => 'ConversationController@show'));
	Route::get('conversation/show-all', array('as' => 'conversation.show.all', 'uses' => 'ConversationController@showAll'));
	// Comments
	Route::get('conversation/{conversation}/comment', array('as' => 'conversation.comment', 'uses' => 'ConversationController@createComment'));
	Route::post('conversation/{conversation}/comment', array('as' => 'conversation.comment', 'uses' => 'ConversationController@createComment'));
	
	// Billing Management
	Route::get('billing/confirmation', array('as' => 'billing.confirmation', 'uses' => 'BillingController@confirmation'));
	Route::get('billing/make-payment', array('as' => 'billing.make-payment', 'uses' => 'BillingController@makePayment'));
	Route::post('billing/make-payment', array('as' => 'billing.make-payment', 'uses' => 'BillingController@makePayment'));
	Route::get('billing/show-outstanding-charges', array('as' => 'billing.show-outstanding-charges', 'uses' => 'BillingController@showOutstandingCharges'));
	Route::post('billing/show-outstanding-charges', array('as' => 'billing.show-outstanding-charges', 'uses' => 'BillingController@showOutstandingCharges'));
	Route::get('billing/show-patient-balance', array('as' => 'billing.show-patient-balance', 'uses' => 'BillingController@showPatientBalance'));
	Route::get('billing/show-payments', array('as' => 'billing.show-payments', 'uses' => 'BillingController@showPayments'));
	Route::post('billing/show-payments', array('as' => 'billing.show-payments', 'uses' => 'BillingController@showPayments'));
	
	// Patient Management
	Route::get('patient/create', array('as' => 'patient.create', 'uses' => 'PatientController@create'));
	Route::post('patient/create', array('as' => 'patient.create', 'uses' => 'PatientController@create'));
	Route::get('patient/show-all', array('as' => 'patient.show.all', 'uses' => 'PatientController@showAll'));
	
	Route::get('/', array('as' => 'home.index', 'uses' => 'HomeController@getIndex'));
    


});


Route::any('/', 'SiteController@getIndex');



// Confide routes
Route::get('users/create', array('as' => 'users.create', 'uses' => 'UsersController@create'));
Route::post('users', 'UsersController@store');
Route::get('users/login', array('as' => 'users.login', 'uses' => 'UsersController@login'));
Route::post('users/login', array('as' => 'users.login', 'uses' => 'UsersController@doLogin'));
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

