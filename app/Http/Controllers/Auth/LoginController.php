<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	 public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }




        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]) || Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password]) ) {
//             return redirect()->intended('admin-dashboard');

            return redirect()->route('home')->with('message','Đăng nhập thành công. ' . $request->user()->email);

        }  else {
            $this->incrementLoginAttempts($request);
            return redirect()->back()->with('error','Nhập sai thông tin vui lòng đăng nhập lại.');
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
//
//    protected function credentials(Request $request): array
//    {
//        if (is_numeric($request->phone_number)) return ['phone_number' => $request->email, 'password' => $request->password];
//        else return ['email' => $request->email, 'password' => $request->password];
//    }
}
