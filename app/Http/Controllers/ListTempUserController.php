<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTempUser;
use App\Link;
use Illuminate\Support\Facades\DB;
class ListTempUserController extends Controller
{
    public function index()
    {
        //$result = ListTempUser::all();
		//$result = ListTempUser::orderByDesc('id')->get();
		// $result = ListTempUser::orderByDesc('id')->paginate(30);
        // return view('admin.danh-sach-tempuser',compact('result'));

        $result = DB::table('term_user as t')
        ->leftJoin('links as l', 't.link_id', '=', 'l.id')
        ->select('t.*','l.content as link_content')
        ->orderBy('t.created_at','DESC')
        ->paginate(10);
        return view('admin.danh-sach-tempuser',compact('result'));

        // return $result;

    }
}
