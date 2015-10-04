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

Route::get('/sendsms', array('uses' => 'SmsController@sendSMS'));
//route to show login form
Route::get('login', array('uses' => 'UserController@showLogin'));
//route to checking login form
Route::post('login', array('uses' => 'UserController@doLogin'));

//route to register
Route::get('register', array('uses' => 'UserController@showRegisterForm'));

Route::post('register', array('uses' => 'UserController@createRegister'));

Route::get('otp', array('as'=>'show-otp', 'uses' => 'UserController@showOtpForm'));
Route::post('otp', array('as'=>'verify-otp', 'uses' => 'UserController@verifyotp'));
Route::post('otp/resend',array('uses'=>'UserController@resendotp'));
Route::get('userinfo',array('uses'=>'UserController@userinfo'));
Route::post('userinfo',array('uses'=>'UserController@updateuser'));
Route::get('/changepwd',array('uses'=>'UserController@changePassword'));