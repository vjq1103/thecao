<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListLogPayment;
class ListLogPaymentController extends Controller
{
    public function index()
    {
        //$result = ListLogPayment::all();
		
		//$result = ListLogPayment::orderByDesc('id')->get()->take(5); 	
        //$result = ListLogPayment::orderByDesc('id')->get();	
		$result = ListLogPayment::orderByDesc('id')->paginate(30);
        return view('admin.danh-sach-log-payment',compact('result'));
    }
}
