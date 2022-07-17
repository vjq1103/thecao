<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Card;
use App\User;
use App\Payment;
use App\Log;
use App\Tinh;
use Config;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function showHistoryAddCard()
    {
        //get user login
        $user = Auth::user()->id;
        $CHUA_XOA = Config::get('constants.CHUA_XOA');

        $result =  DB::table('payments')
            ->leftJoin('users', 'payments.user_id', '=', 'users.id')
            ->leftJoin('cat_cards', 'payments.provider', '=', 'cat_cards.card_code')
            ->where('payments.is_deleted', '=', $CHUA_XOA)
            ->where('users.id', '=', $user)
            ->orderByRaw('payments.payment_id - payments.created_at ASC')
            ->paginate(20);
            return view('user.profile',compact('result'));
    }

    public function showTinh() 
    {
        $result =  Tinh::all();
        return response($result);
    }
	
	
	
    //list user
	
    public function Role2() 
    {
        $listuser= User::all();
        return view('list-user',compact('listuser'));
        // Moi them sua nguoi dung
 
    }
	
	
	
	   // Moi them sua nguoi dung
    public function Role()    {
		$user = User::orderByDesc('created_at')->paginate(30);
        //$user= User::all();
        return view('admin.role',compact('user'));     
 
    }

	
	
	
    //Moi người dùng

    public function updateUser(Request $request)
    {
        $user_id = $request->get('user_id');
        $result = User::find($user_id);
        //$result->name = $request->get('username');
        $result->phone_number = $request->get('phone');
        $result->email = $request->get('email');
        $result->money_1 = $request->get('money_1');
        $result->tam_giu = $request->get('tam_giu');
        $result->is_Admin = $request->get('is_Admin');
        $result->save();
        return redirect()->back()->with('message', 'Update thành công!');
    }
	
	
}
