<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
//    const user = User;
// login function when user click login button in login view
    function doLogin(Request $request)
    {// usecase login
//get email and passwork from request
        $userName = $request->input('email');
        $passWord = $request->input('password');
        //check isactive column in database
        $isActive = User::select('isactive')->where('email', $userName)->get();
//        echo ($isActive[0]);
        //check instance email, password is exit in database and isActive ==1
        if ((Auth::attempt(['email' => $userName, 'password' => $passWord]) && ($isActive[0]->isactive == 1))) {
            //if true return user to home view with Auth
            return redirect()->route('home')->with('user', Auth::user());
        } else {
            //if false return back to login view with mess
            return redirect()->back()->with('error4', 'Wrong account information !!!');
        }


    }

    function login()
    {//use case login
        //return login view
        return view('page.login');
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }


    function register(Request $request)
    {//usecase register
        //random key for confirm
        $randomKey = Str::random(32);
        $input = $request->all();

        //check mail is extis?
        $g = User::select('*')->where('email', $request->input('email'))->count();

        if ($g != 0) {
            return redirect()->route('register')->with('mess', 'Email already exists!!!');
        } else {
            //send mail to user to confirm
            Mail::send('mail.mail', ['key' => $randomKey, 'email' => $request->input('email')], function ($message) use ($input) {
                $message->to($input["email"], 'Client')->subject('Confirm Register');

            });

            //update user's information into database
            $user = new User;
            $user->last_name = $request->input('lastname');
            $user->first_name = $request->input('firstname');
            $user->email = $request->input('email');
            //encrypt key
            $user->password = Hash::make($request->input('password'));
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->key = $randomKey;
            $user->save();
            //return login view
            return redirect()->route('login')->with('mess', 'Sign up successful !!! Please check your email to activate your account.');
        }
    }

    //this function is called when user click on a link attached on mail which is sent when user click button 'register'.
    function confirmRegister($email, $key)
    {// usecase register
        //get key in from database
        $dbKey = User::select('key')->where('email', $email)->get();
//        echo($dbKey[0]->key);

        //check instance key is exit in database
        if ($dbKey[0]->key == $key) {
            //update isactive ==1;
            $randomKey = Str::random(32);
            User::where('email', $email)->update(['isactive' => 1, 'key'=> $randomKey]);

            //return login view with message
            return redirect()->route('login')->with('mess', 'Successful Activation !!! Please enter account information.');
        } else {
            return redirect()->route('login')->with('error4', 'This email has been actived');
        }


    }

    //register & login = google
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->findOrCreate($user, $provider);
        Auth::login($authUser, true);
        return redirect()->to('/home')->with('user', Auth::user());
    }
    public function findOrCreate($user, $provider)
    {
        $userUnique = User::where('email', $user->email)->first();
        if ($userUnique) {
            return $userUnique;
        }
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
//          cái ngoaif trước là nằm dưới database cái ngoài sau là trong laravel
           'first_name' => $user->name,
            'email' => $user->email,
            'provider' => strtoupper($provider),
            'provider_id' => $user->id,
        ]);
    }
}
