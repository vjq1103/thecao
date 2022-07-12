<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListAdXS;
class ListAdXSController extends Controller
{
    public function index()
    {
        //$result = ListAdXS::all();
		$result = ListAdXS::orderByDesc('id')->paginate(60);
        return view('admin.danh-sach-adxs',compact('result'));
    }
}
