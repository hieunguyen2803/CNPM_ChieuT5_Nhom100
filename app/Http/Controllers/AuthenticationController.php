<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Socialite;

class AuthenticationController extends Controller
{
//    const user = User;
// login function when user click login button in login view
    function doLogin(Request $request)
    {// usecase login
//get email and passwork from request
        $userName = $request->input('email');
        $passWord = $request->input('password');
        //check isAcive column in database
        $isActive = User::select('isactive')->where('email', $userName)->get();
//        echo ($isActive[0]);
        //check instance email, password is exit in database and isActive ==1
        if ((Auth::attempt(['email' => $userName, 'password' => $passWord]) && ($isActive[0]->isactive == 1))) {
            //if true return user to home view
            return redirect()->route('home')->with('user', Auth::user());
        } else {
            //if false return back to login view
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
        //send mail to user to confirm
        $g = User::select('*')->where('email', $request->input('email'))->count();
        if ($g != 0) {
            return redirect()->route('register')->with('mess', 'Email already exists!!!');
        }else
        {
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
            User::where('email', $email)->update(['isactive' => 1]);
            //return login view with message
            return redirect()->route('login')->with('mess', 'Successful Activation !!! Please enter account information.');
        } else {
            // echo fail on screen
            echo 'error';
        }


    }

    //login = google
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/home');

        }
        // only allow people with @company.com to login
        if (explode("@", $user->email)[1] !== 'gmail.com') {
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
            echo 'Please Login again';
        } else {
            // create a new user
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->avatar = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }


//login = google & facebook
//    public function redirect($provider)
//    {
//        return Socialite::driver($provider)->redirect();
//    }
//    public function callback($provider)
//    {
//        $getInfo = Socialite::driver($provider)->user();
//        $user = $this->createUser($getInfo,$provider);
//        auth()->login($user);
//        return redirect()->to('/home');
//    }
//    function createUser($getInfo,$provider){
//        $user = User::where('provider_id', $getInfo->id)->first();
//        if (!$user) {
//            $user = User::create([
//                'name'     => $getInfo->name,
//                'email'    => $getInfo->email,
//                'provider' => $provider,
//                'provider_id' => $getInfo->id
//            ]);
//            $user ->assignRole('Super Admin');
//        }
//        return $user;
//    }
}
