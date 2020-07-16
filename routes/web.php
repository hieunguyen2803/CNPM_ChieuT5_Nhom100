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

Route::get( '/', function () {
	return view( 'welcome' );
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

Route::get( "forgot", function () {
	return view( "page.forgot_password" );
} );
Route::get( "forgot_password", function () {
	return view( "page.change_pass_forgot" );
} );
