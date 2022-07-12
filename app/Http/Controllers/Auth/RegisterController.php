<?php

namespace App\Http\Controllers\Auth;

use App\Rules\CheckEmailRule;
use App\Rules\CheckOtpRule;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'ref' => 'required|exists:users',
            'password2' => 'required',
        ];

        if(!empty($data['email'])) {
            //$data['email'] = trim($data['email'], '.'); //Bỏ dấu châm . ở mail
            $rules['email'] = ['string','email','max:255','unique:users', new CheckEmailRule()];
            $rules['maotp'] = [new CheckOtpRule(session('otp_email'))];
        }

        if(!empty($data['phone_number'])){
            $rules['phone_number'] = ['unique:users','digits_between:10,13', new CheckEmailRule()];
            $rules['maotp'] = [new CheckOtpRule(session('otp_phone'))];
        }

        return  Validator::make($data, $rules);

//        return Validator::make($data, [
//            'name' => 'required|string|max:255',
//            'email' => 'string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//            'phone_number' => 'unique:users',
//            'ref' => 'required|unique:users|exists:users',
//            'password2' => 'required',
//            //'tinh' => 'required',
//
//        ]);
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


//       var_dump($inputOtp);  dd($sessionOtp);
//        try {
//            // Validate the value...
//        } catch (Throwable $e) {
//            report($e);
//
//            return false;
//        }



        $Codef = Str::random(6);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'password' => Hash::make($data['password']),
                'phone_number'=>$data['phone_number'] ?? null,
                'password2' =>$data['password2'],
                'ref' => Str::random(6),
                'magioithieu' => Str::random(6),
                //'tinh' =>$data['tinh'],
            ]);
            //return redirect()->route('home')->with('message','Đăng nhập thành công.');


    }

    protected function registered(Request $request, $user)
    {
        return redirect('/home')->with('message', 'Chào mừng: ' . $user->email);
    }
}
