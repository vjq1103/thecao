<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ListFrame;
use App\CardAuto;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function index()
    {
        return view('admin.my-search');
    }

    public function mySearch(Request $request)
    {

        $search =  $request->get('searchID');
        $q = "SELECT
        c.id as id,
        c.serial as serial,
        c.price as price,
        c.status as status,
        c.updated_at as updated_at,
        c.created_at as created_at,
        u.id as user_id,
        u.name as name
    FROM
        card_auto as c
    LEFT JOIN users as u ON c.user_id = u.id
    WHERE c.serial = $search";
        // echo $q;die;
        $user =  DB::select(DB::raw($q));
        $check =  3;
        foreach($user as $value) {
            $check = $value->status;
        }

        if($check === 1){
            return response()->json([
                'code' => 200,
                'data' => $user
            ]);
        } else if ($check === 0) {
            return response()->json([
                'code' => 300,
                'data' => $user
            ]);
        }
        else if ($check === 3) {
            return response()->json([
                'code' => 400,
                'data' => "Thẻ sai hoặc không tồn tại"
            ]);
        }

    }


}
