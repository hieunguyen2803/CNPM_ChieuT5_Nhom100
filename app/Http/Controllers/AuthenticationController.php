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

    //usecase đăng kí
    function register(Request $request)
    {
        //random key cho phần gửi mail xác nhận
        $randomKey = Str::random(32);
        $input = $request->all();

        //check email đã tồn tài hay chưa
        $g = User::select('*')->where('email', $request->input('email'))->count();

        //nếu đã tồn tâị
        if ($g != 0) {
            return redirect()->route('register')->with('mess', 'Email already exists!!!');
        //nếu chưa tồn tại
        } else {
            //gửi mail cho người dùng xác nhận
            Mail::send('mail.mail', ['key' => $randomKey, 'email' => $request->input('email')], function ($message) use ($input) {
                $message->to($input["email"], 'Client')->subject('Confirm Register');

            });

            //cập nhật thông tin user trong db
            $user = new User;
            $user->last_name = $request->input('lastname');
            $user->first_name = $request->input('firstname');
            $user->email = $request->input('email');
            //mã hóa password
            $user->password = Hash::make($request->input('password'));
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->key = $randomKey;
            $user->save();
            //trả về trang login
            return redirect()->route('login')->with('mess', 'Sign up successful !!! Please check your email to activate your account.');
        }
    }

    //chức năng này được gọi khi người dùng nhấp vào liên kết đính kèm thư xác nhận khi đăng kí
    function confirmRegister($email, $key)
    {
        //lấy ra key trong db
        $dbKey = User::select('key')->where('email', $email)->get();
        //echo($dbKey[0]->key);

        //kiểm tra 2 key có trùng nhau k?
        //nếu trùng
        if ($dbKey[0]->key == $key) {
            //random key mới cho người dùng trong db và cập nhật trạng thái active = 1
            $randomKey = Str::random(32);
            User::where('email', $email)->update(['isactive' => 1, 'key'=> $randomKey]);

            //return login view with message
            return redirect()->route('login')->with('mess', 'Successful Activation !!! Please enter account information.');
            //nếu không trùng
        } else {
            return redirect()->route('login')->with('error4', 'This email has been activated');
        }


    }

    //register & login = google + facebook
    //Đăng kí Service Provider trong config/app
    //Thêm thông tin xác thực vào config/services
    //thêm các thông tin vào file cấu hình .env
    //thêm các thông tin user trong db/mig/user
    //tạo route route/web
    public function redirect($provider)
    {
        //redirect user tới trang xác của gg or fb
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        //lấy thông tin người dùng
        $user = Socialite::driver($provider)->stateless()->user();
        //gọi đến funtion bên dưới
        $authUser = $this->findOrCreate($user, $provider);
        //nếu user đúng thì login
        Auth::login($authUser, true);
        return redirect()->to('/home')->with('user', Auth::user());
    }

    public function findOrCreate($user, $provider)
    {
        //find = mail
        $userUnique = User::where('email', $user->email)->first();
        if ($userUnique) {
            return $userUnique;
        }
        //find = provider_id
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        //lưu thông tin vào db
        return User::create([
            'first_name' => $user->name,
            'email' => $user->email,
            'provider' => strtoupper($provider),
            'provider_id' => $user->id,
        ]);
    }
}
