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

Route::get('/', function () {
    return view('welcome');
});
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

//login= google
Route::get('/redirect', 'AuthenticationController@redirectToProvider')->name("redirect");
Route::get('/callback', 'AuthenticationController@handleProviderCallback');

//Lam login = facebook nhưng bị lỗi rồi
//Route::get('/redirect/{provider}', 'AuthenticationController@redirect')->name("redirect");;
//Route::get('/callback/{provider}', 'AuthenticationController@callback');


Route::get( "change_password", function () {
    return view( "page.change_password" );
} );

Route::get( "forgot", function () {
    return view( "page.forgot_password" );
} );
Route::get( "forgot_password", function () {
    return view( "page.change_pass_forgot" );
} );
