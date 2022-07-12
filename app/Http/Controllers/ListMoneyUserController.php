<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListMoneyUser;
class ListMoneyUserController extends Controller
{
    public function index()
    {
		$result = ListMoneyUser::orderByDesc('money_1')->paginate(30);
        return view('admin.danh-sach-listmoney',compact('result'));
    }
}
