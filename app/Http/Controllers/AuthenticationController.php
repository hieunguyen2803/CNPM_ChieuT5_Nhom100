<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller {
	function doLogin( Request $request ) {

		$userName = $request->input( 'email' );
		$passWord = $request->input( 'password' );
		$isActive = User::select( 'isactive' )->where( 'email', $userName )->get();
//        echo ($isActive[0]);

		//Auth::attempt nhận vào mảng gồm email pass để so sánh
		if ( ( Auth::attempt( [
				'email'    => $userName,
				'password' => $passWord
			] ) && ( $isActive[0]->isactive == 1 ) ) ) {
			return redirect()->route( 'home' )->with( 'user', Auth::user() );
		} else {
			return redirect()->back()->withInput();
		}
	}

	function login() {
		return view( 'page.login' );
	}

	function register( Request $request ) {
		$randomKey = Str::random( 32 );
		$input     = $request->all();
		Mail::send( 'mail.mail', [
			'key'   => $randomKey,
			'email' => $request->input( 'email' )
		], function ( $message ) use ( $input ) {
			$message->to( $input["email"], 'Client' )->subject( 'Confirm Register' );
		} );
		$user             = new User;
		$user->last_name  = $request->input( 'lastname' );
		$user->first_name = $request->input( 'firstname' );
		$user->email      = $request->input( 'email' );
		$user->password   = Hash::make( $request->input( 'password' ) );
		$user->phone      = $request->input( 'phone' );
		$user->gender     = $request->input( 'gender' );
		$user->key        = $randomKey;
		$user->save();
		echo( "ok" );

	}

	function confirmRegister( $email, $key ) {
		$dbKey = User::select( 'key' )->where( 'email', $email )->get();
		echo( $dbKey[0]->key );
		if ( $dbKey[0]->key == $key ) {
			User::where( 'email', $email )->update( [ 'isactive' => 1 ] );

			return redirect()->route( 'login' )->with( 'mess', 'OK!!!' );
		}
	}

}
