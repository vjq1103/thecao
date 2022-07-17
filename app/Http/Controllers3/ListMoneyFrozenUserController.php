<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListMoneyFrozenUser;
class ListMoneyFrozenUserController extends Controller
{
    public function index()
    {	
		$result = ListMoneyFrozenUser::orderByDesc('tam_giu')->paginate(30);
        return view('admin.danh-sach-listmoneyrozen',compact('result'));
    }
}
