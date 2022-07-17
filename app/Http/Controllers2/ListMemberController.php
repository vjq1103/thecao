<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListUser;
class ListMemberController extends Controller
{
    public function index()
    {
        $result = ListUser::all();
        return view('admin.danh-sach-member',compact('result'));
    }
}
