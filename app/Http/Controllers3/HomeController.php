<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Card_card;
use Config;

class HomeController extends Controller
{

 
    public function index()
    {
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $result = Card_card::all();
        $q = "select * from cat_cards where card_status= 1";
        $card = DB::select($q);
        return view('home',compact(['result','card']));
    }

    public function getListCard()
    {
        

    }
}
