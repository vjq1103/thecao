<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListFrame;
class ListFrameController extends Controller
{
    public function index()
    {
		
		//$result = ListFrame::orderByDesc('created_at')->get();	
		$result = ListFrame::orderByDesc('created_at')->paginate(30);
        //$result = ListFrame::orderByDesc('created_at')->get();	
        return view('admin.danh-sach-frame',compact('result'));
    }
}
