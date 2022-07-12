<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SpeedSMSAPI;
use Illuminate\Support\Str;
use Mail;

class OtpController extends Controller
{
    public function sendOtp(Request $request){
       if($request->has('email')){
           $this->sendOtpByEmail($request->email);

           return response()->json('Kiểm tra email để lấy mã otp để hoàn tất đăng kí!');
       }

       if($request->has('phone')){
           $this->sendOtpByPhone([$request->phone]);

           return response()->json('Kiểm tra điện thoại để nhập mã OTP vào khung đăng ký!');
       }
       return abort(404);
    }

    public function sendOtpByPhone(array $phones){

        $code = random_int(1000, 9999);
        $api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");// $phones = ["0326098981"];
        $content = "Ma OTP cua ban la: $code";
        $type = 2;
        $sender='Ma Xac Nhan OTP';

        $response = $api->sendSMS($phones, $content, $type, $sender);
        session(['otp_phone' => $code]);
        return response()->json($response);

    }

    public function sendOtpByEmail($email){
        Mail::send('mail', [], function($message) use ($email)
        {	//$random11 = Str::random(6);
            $random11 = random_int(1000, 9999);
            session(['otp_email' => $random11]);
            $message->to($email, 'test')->subject('Xac nhan OTP cua ban la');
            $message->from('hapromb6@gmail.com','Ma OTP cua ban:'.$random11);
        });

        return response()->json('Vui lòng kiểm tra email để lấy mã xác minh OTP nhập vào để hoàn tất đăng ký!');
    }
}
