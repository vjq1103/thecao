<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Card_card;
use App\Card;
use App\Payment;
use App\BuyCard;
use App\User;
use App\Log;
use App\CardAuto;
use Config;
use Facades\Yugo\SMSGateway\Interfaces\SMS;
use App\Classes\SpeedSMSAPI;
use Auth;
class MuaTheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = "select * from cat_cards where card_type= 1";
        $result = DB::select($q);
        $CARD_STATUS = Config::get('constants.CARD_STATUS');
        $card = Card_card::all();
        $user_id = Auth::user()->id;
        //$buy = BuyCard::where('user_id',$user_id)->get();
        $buy = BuyCard::where('user_id',$user_id)->orderByDesc('id')->paginate(10);	
		return view('muathe.index',compact(['result','card','buy']));
    }


    // /xu ly napt the
    public function buyCard(Request $request)
    {
    //  return $request->all();
       $CHUA_XOA = Config::get('constants.CHUA_XOA');
       $CHO_DUYET = Config::get('constants.CHO_DUYET');
       $MUA_THE = Config::get('constants.MUA_THE');
       $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
       $CHUA_NAP = Config::get('constants.CHUA_NAP');
       $DA_NAP = Config::get('constants.DA_NAP');

       $get_money = $request->get('money_1');
       $tam_giu = $request->get('tam_giu');
        $member = $request->get('member');
        $price = $request->get('card_price');
        $qty = $request->get('qty');
        $get_price = $price * $qty;


         //get discount
         $cat_code = $request->get('card_type');
         $cat_card = DB::table('cat_cards')
                         ->where('card_code',$cat_code )
                         ->get();
         $discount = 0;
         foreach($cat_card as $value) {
             $discount = $value->card_discount_buy;
         }
        //tinh toan tong tien
        $amount =  $get_price - ($get_price * $discount) /100;



        if($get_money > $get_price) {
            //the tu sinh
            if($request->get('card_type') === 'xcoin') {
                // tu sinh the
                //$min = 1000100010000;
               // $max = 9900900090000;
                    $pin_auto1 = random_int(1000, 9000); //4
                    $pin_auto2 = random_int(1000, 9000); //4
                    $pin_auto3 = random_int(1000, 9000); //4

                    $serial_auto1 = random_int(1000, 9000); //4
                    $serial_auto2 = random_int(1000, 9000); //4
                    $serial_auto3 = random_int(1000, 9000); //4

                    $pin_auto = $pin_auto1 . $pin_auto2 . $pin_auto3;
                    $serial_auto = $serial_auto1 . $serial_auto2 . $serial_auto3;

                $check = CardAuto::where('pin',$pin_auto)
                                    ->where('serial', $serial_auto)
                                    ->count();
                if($check < 1) {
                    $card_auto = CardAuto::create([
                           'pin' => $pin_auto,
                           'serial' => $serial_auto,
                           'price' => $get_price,
                           'status' => $CHUA_NAP,
                           'user_id'  => $request->get('user_id'),
                           'card_code' => $request->get('card_type')
                       ]);

                       // tru tien user
                       $user_id = $request->get('user_id');
                       $user = User::find($user_id);
                       $user->money_1 = $get_money -  $amount;
                       $user->save();

                       $buy_card = BuyCard::create([
                        'user_id' => $request->get('user_id'),
                        'card_provider_code' => $cat_code,
                        'card_provider_name'=> $value->card_name,
                        'card_discount'=> $discount,
                        'card_amount'=> $amount,
                        'card_amount_discount' => $discount,
                        'card_qty' => $qty,
                        'card_prices' =>  $get_price,
                        'card_prices_discounted' => 0,
                        'money_before' => null,
                        'money_after' =>null,
                        'card_notes' => null,
                        'card_info' => null,
                        'card_pin'=> $pin_auto,
                        'card_serial' => $serial_auto,
                        'status' => $CHAP_NHAN,
                        'is_deleted'=>$CHUA_XOA
                    ]);
                        //log
                       $log = Log::create([
                           'log_user_id' => $user_id,
                           'log_content' => 'Mua thẻ xcoin thành công, trừ tiền TK',
                           'log_amount'=>  $amount,
                           'log_time'=> $MUA_THE,
                           'log_type' => "MUA THE xcoin",
                           'log_read' => 3
                       ]);
                } else {
                    $pin_auto4 = random_int(1000, 9000); //4
                    $pin_auto5 = random_int(1000, 9000); //4
                    $pin_auto6 = random_int(1000, 9000); //4

                    $serial_auto4 = random_int(1000, 9000); //4
                    $serial_auto5 = random_int(1000, 9000); //4
                    $serial_auto6 = random_int(1000, 9000); //4

                    $pin_auto7 = $pin_auto4 . $pin_auto5 . $pin_auto6;
                    $serial_auto7 = $serial_auto4 . $serial_auto5 . $serial_auto6;

                    $card_auto = CardAuto::create([
                        'pin' => $pin_auto7,
                        'serial' => $serial_auto7,
                        'price' => $get_price,
                        'status' => $CHUA_NAP,
                        'user_id'  => $request->get('user_id'),
                        'card_code' => $request->get('card_type')
                    ]);

                    // tru tien user
                    $user_id = $request->get('user_id');
                    $user = User::find($user_id);
                    $user->money_1 = $get_money -  $amount;
                    $user->save();

                    // ghi vao buycard
                    $buy_card = BuyCard::create([
                        'user_id' => $request->get('user_id'),
                        'card_provider_code' => $cat_code,
                        'card_provider_name'=> $value->card_name,
                        'card_discount'=> $discount,
                        'card_amount'=> $amount,
                        'card_amount_discount' => $discount,
                        'card_qty' => $qty,
                        'card_prices' =>  $get_price,
                        'card_prices_discounted' => 0,
                        'money_before' => null,
                        'money_after' =>null,
                        'card_notes' => null,
                        'card_info' => null,
                        'card_pin'=> $pin_auto7,
                        'card_serial' => $serial_auto7,
                        'status' => $CHAP_NHAN,
                        'is_deleted'=>$CHUA_XOA
                    ]);
				
                     //log
                    $log = Log::create([
                        'log_user_id' => $user_id,
                        'log_content' => 'Mua thẻ xcoin thành công, trừ tiền vào tk',
                        'log_amount'=>  $amount,
                        'log_time'=> $MUA_THE,
                        'log_type' => "MUA THE",
                        'log_read' => 3
                    ]);
                }

                //
             } else {
                $result = BuyCard::create([
                    'user_id' => $request->get('user_id'),
                    'card_provider_code' => $cat_code,
                    'card_provider_name'=> $value->card_name,
                    'card_discount'=> $discount,
                    'card_amount'=> $amount,
                    'card_amount_discount' => $discount,
                    'card_qty' => $qty,
                    'card_prices' =>  $get_price,
                    'card_prices_discounted' => 0,
                    'money_before' => null,
                    'money_after' =>null,
                    'card_notes' => null,
                    'card_info' => null,
                    'card_pin'=> null,
                    'card_serial' =>null,
                    'status' => $CHO_DUYET,
                    'is_deleted'=>$CHUA_XOA
                ]);
                  // tru tien
                $mess = "Trừ tiền mua thẻ, chuyển tiền vào tạm giữ: - ".  $amount;
                $user_id = $request->get('user_id');
                $user = User::find($user_id);
                $user->money_1 = $get_money -  $amount;
                $user->tam_giu = $tam_giu +  $amount;
                $user->save();
                //log
                $log = Log::create([
                    'log_user_id' => $user_id,
                    'log_content' => $mess,
                    'log_amount'=>  $amount,
                    'log_time'=> $MUA_THE,
                    'log_type' => "MUA THE",
                    'log_read' => 3
                ]);
             }
			 
			$SITE = Config::get('constants.SITE');
			$SMSMUA = Config::get('constants.SMSMUA');
			$SDT1 = Config::get('constants.SDT1');
			$SDT2 = Config::get('constants.SDT2');			
			if($SMSMUA === 1)  {  			
			$contentSMS = $SITE." - Buy card ".$request->get('card_type')." Menh gia: ".number_format($get_price);		
			SMS::send([$SDT1,$SDT2], $contentSMS);		
			}
			
			
			//$contentSMS = "SMSPAY.ME - Buy card:  ".$request->get('card_type')." Gia ".number_format($get_price);
			//SMS::send(['0924861389'], $contentSMS);
            return redirect()->back()->with('message', 'Xem thẻ trong lịch sử mua thẻ!');

        } else {
            return redirect()->back()->with('error', 'Số tiền trong tài khoản không đủ!');
        }


    }
}
