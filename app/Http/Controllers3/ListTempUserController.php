<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTempUser;
class ListTempUserController extends Controller
{
    public function index()
    {
        //$result = ListTempUser::all();
		//$result = ListTempUser::orderByDesc('id')->get();
		$result = ListTempUser::orderByDesc('id')->paginate(30);
        return view('admin.danh-sach-tempuser',compact('result'));
    }
}
