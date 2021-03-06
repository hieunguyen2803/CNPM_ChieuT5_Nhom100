<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function () {
	return view( 'page.home' );
} );
Route::get( "home", function () {
	return view( "page.home" );
} )->name( 'home' );
Route::get( "login", 'AuthenticationController@login' )->name("lo");
Route::get( "register", function () {
	return view( "page.register" );
} );
Route::get( "doctor", function () {
//    return view( "page.doctor" );
    return Redirect::to('https://healthcaree.herokuapp.com/');
} )->name( 'doctor' )->middleware('checkMiddleware');
Route::post( "login", 'AuthenticationController@doLogin' )->name( "login" );
Route::post( "register", 'AuthenticationController@register' )->name( "register" );
Route::get( "confirmRegister/{email}/{key}", 'AuthenticationController@confirmRegister' )->name( "confirmRegister" );
Route::get( "logout", 'AuthenticationController@logout' )->name( "logout" );
Route::get( "profile", function (){
    return view('page.profile');
})->name( "profile" );

//login facebook google
Route::get('/auth/{provider}','AuthenticationController@redirect');
Route::get('/auth/{provider}/callback','AuthenticationController@handleProviderCallback');

Route::get( "change_password", function () {
	return view( "page.change_password" );
} )->name("change_pass");

Route::get( "forgot", function () {
	return view( "page.forgot_password" );
} );
Route::get( "forgot_password", function () {
	return view( "page.change_pass_forgot" );
} );
Route::get( "forgot_password", 'ForgotPasswordController@forgot' );

Route::post( "forgot_password", 'ForgotPasswordController@password' )->name( 'forgot_password' );

Route::get( "reset_password/{email}/{key}", 'ForgotPasswordController@reset' );
Route::post( "reset_password/{email}/{key}", 'ForgotPasswordController@resetPassword' )->name( "reset_password" );

