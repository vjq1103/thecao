<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListLog;
use App\User;

use Auth;
class HistoryController extends Controller
{
    public function index()
    {
		
        $user_id = Auth::user()->id;
		$result = ListLog::where('log_user_id', $user_id)->orderByDesc('log_id')->paginate(30);
         
        return view('user.history',compact('result'));
    }
}
