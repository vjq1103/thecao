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
            ->paginate(10);
            return view('user.profile',compact('result'));
    }

    public function showTinh() 
    {
        $result =  Tinh::all();
        return response($result);
    }
}
