<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthenticationController;
Route::get( "hello", 'welcom to world' );
Route::get( '/', function () {
	return view( 'page.home' );
} );
Route::get( "home", function () {
	return view( "page.home" );
} )->name( 'home' );
Route::get( "login", 'AuthenticationController@login' );
Route::get( "register", function () {
	return view( "page.register" );
} );
Route::post( "login", 'AuthenticationController@doLogin' )->name( "login" );
Route::post( "register", 'AuthenticationController@register' )->name( "register" );
Route::get( "confirmRegister/{email}/{key}", 'AuthenticationController@confirmRegister' )->name( "confirmRegister" );

Route::get( "change_password", function () {
	return view( "page.change_password" );
} );
Route::get( "fogot", function () {
	return view( "page.reset_password" );
} );

Route::get( "forgot_password", 'ForgotPasswordController@forgot' );

Route::post( "forgot_password", 'ForgotPasswordController@password' )->name('forgot_password');

Route::get( "reset_password/{email}/{key}", 'ForgotPasswordController@reset' );
Route::post( "reset_password/{email}/{key}", 'ForgotPasswordController@resetPassword' )->name("reset_password");
