<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


//<<<<<<< HEAD
class ForgotPasswordController extends Controller {
	//create key
	private $key;

	//1: Return view forgot_password
	public function forgot() {
		return view( 'page.forgot_password' );
	}
	//2:
	public function password( Request $request ) {
		//2.1: Random key với chiều dài 50 ký tự
		$this->key = Str::random( 50 );
		//2.2: Gọi tới email và update key của email thành key vừa random
		User::where( 'email', $request->email )->update( [ 'key' => $this->key ] );
		//2.3: Request email trong user
		$user = User::where( 'email', $request->email )->first();

		if ( $user == null ) {
			return redirect()->back()->with( [ 'error' => 'Email not exists' ] );
		}
		//2.4: Request email và lấy ra key
		$dbKey = User::select( 'key' )->where( 'email', $request->email )->get();
		echo( $dbKey );
		echo( $this->key );
		//2.5: Nếu key request được bằng key random thì gọi hàm sendEmail
		if ( $dbKey[0]->key == $this->key ) {
			$this->sendEmail( $user, $dbKey[0]->key );
		}

		return redirect()->back()->with( [ 'success' => 'Reset code sent to your email.' ] );
	}

	//3: Gửi email cho user
	function sendEmail( $user, $key ) {
		Mail::send( 'page.forgot',
			[ 'user' => $user, 'key' => $key ],
			function ( $message ) use ( $user ) {
				$message->to( $user->email );
				$message->subject( "$user->email, reset your password," );
			}
		);
	}

	//4:
	public function reset( $email, $key ) {
		//4.1: Lấy ra key của email truyền vào
		$dbKey = User::select( 'key' )->where( 'email', $email )->get();
		//4.2: Lấy ra email
		$user  = User::where( 'email', $email )->first();

		if ( $user == null ) {
			return redirect()->back()->with( [ 'error' => 'Email not exists' ] );
		} else {
			//4.3: Nếu key truyền vào bằng key của email thì gọi tới trang reset_password
			if ( $key == $dbKey[0]->key ) {
				return view( 'page.reset_password' )->with( [ 'user' => $user, 'key' => $key ] );
			} else {
				return redirect( '/' );
			}
		}
	}

	//5: Đặt lại mật khẩu mới
	public function resetPassword( Request $request, $email, $key ) {
		//5.1: Lấy ra key của email truyền vào
		$dbKey = User::select( 'key' )->where( 'email', $email )->get();
		//5.2: Lấy ra email
		$user  = User::where( 'email', $email )->first();
		if ( $user == null ) {
			return redirect()->back()->with( [ 'error' => 'Email not exists' ] );
		} else {
			//4.3: Nếu key truyền vào bằng key của email thì:
			if ( $key == $dbKey[0]->key ) {
				//4.3.1: Hash password mới nhập
				$pass = Hash::make( $request->input( 'password' ) );
				//4.3.2: Update password mới vào database
				User::where( 'email', $request->email )->update( [ 'password' => $pass ] );
				//4.3.3: Trả về trang login
				return redirect( '/login' )->with( 'success', 'Please login with password new.' );
			} else {
				return redirect( '/' );
			}
		}
	}
//=======
class ForgotPasswordController extends Controller
{
    //create key
    private $key;

    //1: Return view forgot_password
    public function forgot()
    {
        return view('page.forgot_password');
    }

    //2:
    public function password(Request $request)
    {
        //2.1: Random key với chiều dài 50 ký tự
        $this->key = Str::random(50);
        //2.2: Gọi tới email và update key của email thành key vừa random
        User::where('email', $request->email)->update(['key' => $this->key]);
        //2.3: Request email trong user
        $user = User::where('email', $request->email)->first();
        $isActive = User::select('isactive')->where('email', $request->email)->get();

        if ($user == null || ($isActive[0]->isactive == 0)) {
            return redirect()->back()->with(['error' => 'Email not exists']);
        }
        //2.4: Request email và lấy ra key
        $dbKey = User::select('key')->where('email', $request->email)->get();
        echo($dbKey);
        echo($this->key);
        //2.5: Nếu key request được bằng key random thì gọi hàm sendEmail
        if ($dbKey[0]->key == $this->key && ($isActive[0]->isactive == 1)) {
            $this->sendEmail($user, $dbKey[0]->key);
        }

        return redirect()->back()->with(['success' => 'Reset code sent to your email.']);
    }

    //3: Gửi email cho user
    function sendEmail($user, $key)
    {
        Mail::send('page.forgot',
            ['user' => $user, 'key' => $key],
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject("$user->email, reset your password,");
            }
        );
    }

    //4:
    public function reset($email, $key)
    {
        //4.1: Lấy ra key của email truyền vào
        $dbKey = User::select('key')->where('email', $email)->get();
        //4.2: Lấy ra email
        $user = User::where('email', $email)->first();
        $isActive = User::select('isactive')->where('email', $email)->get();

        if ($user == null || ($isActive[0]->isactive == 0)) {
            return redirect()->back()->with(['error' => 'Email not exists']);
        } else {
            //4.3: Nếu key truyền vào bằng key của email thì gọi tới trang reset_password
            if ($key == $dbKey[0]->key && ($isActive[0]->isactive == 1)) {
                return view('page.reset_password')->with(['user' => $user, 'key' => $key]);
            } else {
                return redirect('/');
            }
        }
    }

    //5: Đặt lại mật khẩu mới
    public function resetPassword(Request $request, $email, $key)
    {
        //5.1: Lấy ra key của email truyền vào
        $dbKey = User::select('key')->where('email', $email)->get();
        //5.2: Lấy ra email
        $user = User::where('email', $email)->first();
        $isActive = User::select('isactive')->where('email', $email)->get();
        if ($user == null || ($isActive[0]->isactive == 0)) {
            return redirect()->back()->with(['error' => 'Email not exists']);
        } else {
            //4.3: Nếu key truyền vào bằng key của email thì:
            if ($key == $dbKey[0]->key && ($isActive[0]->isactive == 1)) {
                //4.3.1: Hash password mới nhập
                $pass = Hash::make($request->input('password'));
                //4.3.2: Update password mới vào database
                User::where('email', $request->email)->update(['password' => $pass]);
                //4.3.3: Trả về trang login
                return redirect('/login')->with('success', 'Please login with password new.');
            } else {
                return redirect('/');
            }
        }
    }
//>>>>>>> 662ab192726b254b10ef8ced0b9cc8f360b96514
}
