<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Card_card;
use App\Card;
use App\Payment;
use Config;
use Auth;
use Facades\Yugo\SMSGateway\Interfaces\SMS;
use App\Classes\SpeedSMSAPI;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
require("SpeedSMSAPI.php");
class NaptheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        
        $user = Auth::user()->id;
        $h = "select *,c.card_name from payments left join cat_cards c On payments.provider = c.card_code where user_id = $user and payments.payment_status =0";
        $hsitory = DB::select($h);
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $card = Card_card::all();
        $q = "select * from cat_cards where card_status= 1";
        $result = DB::select($q);
        return view('napthe.index',compact(array('result','hsitory','card')));
    }


     



    //function nap the tu web
    public function napthecao(Request $request) {

        $IMAGES = Config::get('constants.IS_IMAGE');
        $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
		//get discount
        $q = Card_card::where('card_code',$request->get('card_type'))->get();
        $card_discount = null;
        foreach($q as $value) {
            $card_discount = $value['card_discount'];
        }
		
	 
		//Mi thu vardum no ra xem da gui du lieu len chua, no tra ve ko
		// nhu nay, no la lay du lieu ve ma, cai nay la gi requestRecharge_Cuoc3MienCom
		// Request qua he thong Cuoc3MienCom
     
            $TKAPI = Config::get('constants.TKAPI');
            $MKAPI = Config::get('constants.MKAPI');
		    $res = json_decode(requestRecharge_Cuoc3MienCom([
			"authUsername" => $TKAPI,
			"authPassword" => $MKAPI,
			"selProvider" => $request->get('card_type'),
			"txtCardNumber" => $request->get('card_pin'),
			"txtCardSeri" => $request->get('card_seria'),
			"txtCardValue" => $request->get('card_price')
		]));
		 
		
		if($res->errorCode == 1){
			$CardValue = $res->errorPayload->cardValue; // Menh gia thuc cua the
			// Xu ly ket qua the chinh xac - xử lí kết quả thẻ chính xác
			$result = Payment::create([
                'phone' => $request->get('user_phone'),
                'card_type_id' => $request->get('card_price'),
                'pin' => $request->get('card_pin'), //pin
                'serial' => $request->get('card_seria'), //serri
                'provider' => $request->get('card_type'), //mang
                'user_id' => $request->get('user_id'),
                'link_id' => null,
                'ip_request' => null,
                'price' => $request->get('card_price'),
                'amount' => 0,
                'rate' => $card_discount,
                'transaction_id' => str_random(10),
                'balance' => 0,
                'requestId' => null,
                'topup_type' => 0,
                'is_image' =>  $NOT_IMAGES,
                'image_url' => null,
                'notes' => $res->errorMessage,
                'payment_status' =>  2,
                'is_deleted' => $CHUA_XOA,            
           ]);
			
		}else{
				// Xu ly the sai - thẻ lỗi?
			$result = Payment::create([
                'phone' => $request->get('user_phone'),
                'card_type_id' => $request->get('card_price'),
                'pin' => $request->get('card_pin'), //pin
                'serial' => $request->get('card_seria'), //serri
                'provider' => $request->get('card_type'), //mang
                'user_id' => $request->get('user_id'),
                'link_id' => null,
                'ip_request' => null,
                'price' => $request->get('card_price'),
                'amount' => 0,
                'rate' => $card_discount,
                'transaction_id' => str_random(10),
                'balance' => 0,
                'requestId' => null,
                'topup_type' => 0,
                'is_image' =>  $NOT_IMAGES,
                'image_url' => null,                
                'notes' => $res->errorMessage,
                'payment_status' =>  3,
                'is_deleted' => $CHUA_XOA,            
           ]);
        }
		
        //CHECK NAP BANG THE HAY ANH		
        if($request->get('nap_the')  ==  $NOT_IMAGES) {
            $result = Payment::create([
                'phone' => $request->get('user_phone'),
                'card_type_id' => $request->get('card_price'),
                'pin' => $request->get('card_pin'), //pin
                'serial' => $request->get('card_seria'), //serri
                'provider' => $request->get('card_type'), //mang
                'user_id' => $request->get('user_id'),
                'link_id' => null,
                'ip_request' => null,
                'price' => $request->get('card_price'),
                'amount' => 0,
                'rate' => $card_discount,
                'transaction_id' => str_random(10),
                'balance' => 0,
                'requestId' => null,
                'topup_type' => 0,
                'is_image' =>  $NOT_IMAGES,
                'image_url' => null,
                'notes' => null,
                'payment_status' =>  $CHO_DUYET,
                'is_deleted' => $CHUA_XOA,            
           ]);
        } else {
            $file = $request->file('img');
            $messages = [
             'image' => 'Định dạng không cho phép',
             'max' => 'Kích thước file quá lớn',
         ];
             // Điều kiện cho phép upload
             $this->validate($request, [
                 'file' => 'image|max:2028',
             ], $messages);
     
            if ($request->file('img')->isValid()){
                 // Lấy tên file
				$day = Carbon::now()->day; //ngày
				$month =Carbon::now()->month; //tháng
				$year =Carbon::now()->year; //năm	
				
                $file_path = "/uploads/$year/$month/$day/";		
                 $file_name = $year."-".$month."-".str_random(10)."-".$request->file('img')->getClientOriginalName();
                 //$file_name = $request->file('img')->getClientOriginalName();
                 // Lưu file vào thư mục upload với tên là biến $filename
                 $urlFile = $request->file('img')->move('uploads/2019/02',$file_name);
				 //$year,$month,$day,
             }


            $result = Payment::create([
                'phone' => $request->get('user_phone'),
                'card_type_id' => $request->get('card_price'),
                'pin' => 0,
                'serial' => 0,
                'provider' => $request->get('card_type'),
                'user_id' => $request->get('user_id'),
                'price' => $request->get('card_price'),
                'amount' => 0,
                'rate' => $card_discount,
                'transaction_id' => str_random(10),
                'balance' => 0,
                'topup_type' => 0,
                'is_image' => $IMAGES,
                'image_url' => $urlFile,
                'notes' => null,
                'payment_status' => $CHO_DUYET,
                'is_deleted' => $CHUA_XOA,            
           ]);
        }
      
       if($result) {
          
        
                $api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");            
                $api->sendSMS(["","0394826385"], " Frame Phone: " .$request->get('phone'). " - Price ".number_format($amount). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');   
                
		   
		 
        $SITE = Config::get('constants.SITE');
        $SMSNAP = Config::get('constants.SMSNAP');
        $SDT1 = Config::get('constants.SDT1');
        $SDT2 = Config::get('constants.SDT2');
		   
		if($SMSNAP === 1)  {  
		//Ham gui sms ve dien thoai   
		$contentSMS = $SITE." - Truc tiep ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin').$SDT2.$SDT1;
		SMS::send([$SDT1,$SDT2], $contentSMS);
		}
		//SMS::send(['',''], $contentSMS);
        return redirect()->back()->with('message', 'Đã nạp lên hệ thống nhà mạng.'); 
			 
       }
       return false;
    }

    //function hsitory napthe

    public function Historycard()
    {
        $idsort = 1;
        //$idsort++;
        $user = Auth::user()->id;
        $q = "select *,c.card_name from payments left join cat_cards c On payments.provider = c.card_code where user_id = $user";
        $hsitory = DB::select($q)->paginate(8);
		
        return view('napthe.index',compact('hsitory', 'idsort'));
    }

    public function HistoryPending()
    {
        $user = Auth::user()->id;        
        $today = Carbon::today();
        $today = $today->format('Y-m-d');

        $hsitory = DB::table('payments')
                ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                ->leftJoin('cat_cards as c', 'payments.provider', '=', 'c.card_code')
                ->where('payments.user_id', '=', $user) 
			  ->where('payments.created_at','Like',"%{$today}%")
                ->select('c.card_name','payments.pin','payments.serial','c.card_code','payments.payment_status','payments.link_id','payments.payment_id',
                    'payments.image_url',
                    'payments.is_image',
                    'payments.price',
                    'payments.rate',
                    'payments.balance',
                    'payments.balance_before',
                    'users.chiet_khau_frame',
                    'users.member',
                    'users.level',
                    'payments.transaction_id',
                    'payments.notes',
                    'payments.created_at as created'

                )
                ->orderByRaw('payments.payment_id - payments.created_at ASC')
                ->paginate(10);
                //dd($today); 
               // SELECT * FROM `payments` WHERE `created_at` LIKE '%2019-04-07%'
			   
             $count_today_muathe = DB::table('payments')
                ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                ->leftJoin('cat_cards as c', 'payments.provider', '=', 'c.card_code')
                ->where('payments.user_id', '=', $user) 
                ->where('payments.created_at','Like',"%{$today}%")
				->select(DB::raw('SUM(payments.price) as tong_tien_mua_the'))
				->first();
				
			$count_today_amout =  DB::table('payments')
                ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                ->leftJoin('cat_cards as c', 'payments.provider', '=', 'c.card_code')
                ->where('payments.user_id', '=', $user) 
                ->where('payments.created_at','Like',"%{$today}%")
				->select(DB::raw('SUM(payments.amount) as tong_amount'))
				->first();
	
        return view('history.napthe',compact(['hsitory','count_today_muathe','count_today_amout']));
    }



//function history napthe trong ngay
     public function Historycardtoday()
    {
        $user = Auth::user()->id;
        $q = "select *,c.card_name from payments left join cat_cards c On payments.provider = c.card_code where user_id = $user";
        $hsitory = DB::select($q)->paginate(10);
        
        return view('napthe.index',compact('hsitory'));
    }


    public function HistoryPendingtoday()
    {
        $user = Auth::user()->id;
        $today = Carbon::today();
        $hsitorytody = DB::table('payments')
                ->leftJoin('users', 'payments.user_id', '=', 'users.id')
                ->leftJoin('cat_cards as c', 'payments.provider', '=', 'c.card_code')
                ->where('payments.user_id', '=', $user) 
                ->select('c.card_name','payments.pin','payments.serial','c.card_code','payments.payment_status','payments.link_id','payments.payment_id',
                    'payments.image_url',
                    'payments.is_image',
                    'payments.price',
                    'payments.rate',
                    'users.chiet_khau_frame',
                    'users.member',
                    'users.level',
                    'payments.transaction_id',
                    'payments.notes',
                    'payments.created_at as created'

                )
                ->orderByRaw('payments.payment_id - payments.created_at ASC')
                ->paginate(10);
                // return $hsitory;
        return view('history.naptrongngay',compact('naptrongngay'));
    }





 








    public function deleteCard(Request $request)
    {
        $id = $request->get('id');
        $q = "DELETE FROM payments where payment_id = $id";
        $result = DB::select($q);
        return redirect()->back()->with('message', 'Xử lý thành công!');

    }
}
