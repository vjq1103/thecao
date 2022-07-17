<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Log;
use Config;
use App\Deposit;
use Auth;
class NaptienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $result = Deposit::where('user_id',$user_id)->paginate(10);
        return view('naptien.index',compact('result'));
    }

    //function nap tien
    public function NapTien(Request $request)
    {
        
        $CHUA_NAP_TIEN = Config::get('constants.CHUA_NAP_TIEN');
        $CHUA_CONFIRM = Config::get('constants.CHUA_CONFIRM');

        $user_pass2 = Auth::user()->password2;
        $user_id = $request->get('user_id');
        $user_name = $request->get('username');

        if($user_pass2 == $request->get('password2')) {
            $return = Deposit::create([
                'user_id' => $user_id,
                'user_name'=> $user_name,
                'deposit_amount'=> $request->get('money_nap'),
                'user_last_confirm'=> $CHUA_CONFIRM,
                'deposit_status'=> $CHUA_NAP_TIEN
            ]);
            return redirect()->action(
                'NaptienController@pockup', ['id' => $return->id,'amount'=>$return->deposit_amount]
            );

        } 
        return redirect()->back()->with('error', 'Mật khẩu cấp 2 không đúng!');
    }

    public function pockup(Request $request)
    {
       $id = $request->get('id');
       $amount = $request->get('amount');

       return view('naptien.pockup',compact(['id','amount']));
    }
    // xac nhan chuyen khoan
    public function confirmChuyenKhoan()
    {

    }

    //confirm
    public function confirm(Request $request)
    {
        $CONFIRM_NAP_TIEN = Config::get('constants.CONFIRM_NAP_TIEN');
        
        $return = Deposit::find($request->get('id'));
        $return->user_last_confirm = $CONFIRM_NAP_TIEN ;
        $return->save();
        return redirect('/nap-tien');
    }

    //list all

    
}
