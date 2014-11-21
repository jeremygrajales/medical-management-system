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

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('appointment', '[0-9]+');


Route::get('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentsController@create'));
Route::post('appointment/create', array('as' => 'appointment.create', 'uses' => 'AppointmentsController@create'));

Route::get('appointment/{appointment}/show', array('as' => 'appointment.show', 'uses' => 'AppointmentsController@show'));

Route::get('appointment/show-all', array('as' => 'appointment.show.all', 'uses' => 'AppointmentsController@showAll'));

Route::get('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentsController@edit'));
Route::post('appointment/{appointment}/edit', array('as' => 'appointment.edit', 'uses' => 'AppointmentsController@edit'));

Route::get('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentsController@statusEdit'));
Route::post('appointment/{appointment}/status/edit', array('as' => 'appointment.status.edit', 'uses' => 'AppointmentsController@statusEdit'));