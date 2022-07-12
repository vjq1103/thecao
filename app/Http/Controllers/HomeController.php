<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Card_card;
use Config;
use App\News;
class HomeController extends Controller
{


    public function index()
    {
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $result = Card_card::all();
        $q = "select * from cat_cards where card_status= 1";
        $card = DB::select($q);
        $new = News::orderByDesc('id')->paginate(3);;
        return view('home',compact(['result','card','new']));
    }

    public function getListCard($id)
    {
        return "OK";

    }
}
