<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     *     //protected $redirectTo = '{{ route('nap-the') }}';
     *     //protected $redirectTo = '/';
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|unique:users',
            'ref' => 'required|unique:users',
            'password2' => 'required',
            //'tinh' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // Mail::raw('Hi, welcome user!', function ($message) {
        //   $message->to($data['email'])
        //     ->subject("Email xac nhan");
        // });

    //     Mail::send('mail', array('name'=>"linhngvi",'email'=> "linhngvi@gmail.com", 'content'=>"Hello from Website"), function($message){
	   //     $message->to("linhngvi@gmail.com", "xxxx")->subject('Email xac nhan!');
	   // });

        //Check OTP
        //1. Lấy input otp
        //2. Get lại session otp
        //3. Check điều điện thỏa mãn thì tạo người dùng thành công

        $inputOtp = $data['maotp'];
        var_dump($inputOtp);
        $sessionOtp =  session('otp_email');
        dd($sessionOtp);


        if ( $data['maotp'] == $sessionOtp)
        {

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_number'=>$data['phone_number'],
                'password2' =>$data['password2'],
                'ref' =>Str::random(6),
                //'tinh' =>$data['tinh'],
            ]);


        }

        return;


    }
}
