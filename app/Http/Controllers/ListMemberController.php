<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListUser;
class ListMemberController extends Controller
{
    public function index()
    {
        //$result = ListUser::orderByDesc('created_at')->get();	
		$result = ListUser::orderByDesc('created_at')->paginate(30);		
        return view('admin.danh-sach-member',compact('result'));
    }
}
