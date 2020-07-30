<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
//    const user = User;
// login function when user click login button in login view
    function doLogin(Request $request){// usecase login
//get email and passwork from request
        $userName = $request->input('email');
        $passWord = $request->input('password');
        //check isAcive column in database
        $isActive = User::select('isactive')->where('email', $userName)->get();
//        echo ($isActive[0]);
        //check instance email, password is exit in database and isActive ==1
        if ((Auth::attempt(['email'=>$userName, 'password' =>$passWord])  && ($isActive[0]->isactive ==1)) ){
            //if true return user to home view
            return redirect()->route('home')->with('user', Auth::user());
        }else{
            //if false return back to login view
            return redirect()->back()->withInput();
        }


    }
    function login(){//use case login
        //return login view
        return view('page.login');
    }

//
    function register(Request $request){//usecase register
        //random key for confirm
        $randomKey = Str::random(32);
        $input = $request->all();
        //send mail to user to confirm
        Mail::send('mail.mail',['key' => $randomKey,'email'=>$request->input('email')], function($message) use ($input) {
            $message->to($input["email"], 'Client')->subject('Confirm Register');
        });
        //update user's information into database
        $user = new User;
        $user-> last_name = $request->input('lastname');
        $user-> first_name = $request->input('firstname');
        $user-> email = $request->input('email');
        $user-> password  = Hash::make($request->input('password'));
        $user-> phone = $request->input('phone');
        $user-> gender = $request->input('gender');
        $user-> key = $randomKey;
        $user->save();


    }
    //this function is called when user click on a link attached on mail which is sent when user click button 'register'.
    function confirmRegister($email,$key){// usecase register
        //get key in from database
        $dbKey = User::select('key')->where('email',$email)->get();
//        echo($dbKey[0]->key);
        //check instance key is exit in database
        if ($dbKey[0]->key==$key){
            //update isactive ==1;
            User::where('email', $email) -> update(['isactive' => 1]);
            //return login view with message
            return redirect() ->route('login') ->with('mess', 'OK!!!');
        }else{
            // echo fail on screen
            echo 'fail';
        }
    }

}
