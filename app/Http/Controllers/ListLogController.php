<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListLog;
class ListLogController extends Controller
{
    public function index()
    {
		
		$result = ListLog::orderByDesc('log_id')->paginate(30);
        //$result = ListLog::orderByDesc('log_id')->get();	
        return view('admin.danh-sach-log',compact('result'));
    }
}
