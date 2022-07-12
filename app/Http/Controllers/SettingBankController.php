<?php

namespace App\Http\Controllers;

use App\Card_card;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SetingData;
use App\User;

class SettingBank extends Controller
{

    public function index()
    {

        $result = SetingBank::all();
        SettingBank::find(2);
        $q = "select * from setting_bank";
        $card = DB::select($q);
        $new = News::orderByDesc('id')->paginate(3);;
        return view(['naptien.index'],compact(['result','card','new'])); //Tra về chỉ 1 view //Trả về compact: result->..  $card->.. / $new->...
    }

    public function getListCard($id)
    {
        return "OK";

    }

}
