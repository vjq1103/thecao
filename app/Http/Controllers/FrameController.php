<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Payment;
use App\Log;
use App\Link;
use Config;
use Auth;
use App\Card_card;
use App\Card;
use App\TermUser;
use App\LogPayment;
use App\ListUser;
use App\Classes\SpeedSMSAPI;
use Facades\Yugo\SMSGateway\Interfaces\SMS;
use App\CardAuto;
require("SpeedSMSAPI.php");


class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::user()->id;
        $result = Link::where('user_id',$user_id) ->where('status','0') ->orderBy('created_at', 'desc')->paginate(50);
        return view('frame.index',compact(['result']));return view('frame.index',compact(['result']));
    }
    public function framehienthi()
    {

        $user_id = Auth::user()->id;
        $result = Link::where('user_id',$user_id) ->where('status','0') ->orderBy('created_at', 'desc')->paginate(50);
        return view('frame.framehienthi',compact(['result']));return view('frame.framehienthi',compact(['result']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFrame(Request $request)
    {

        $id =  random_int(1, 9999);
        $CHUA_XOA = Config::get('constants.CHUA_XOA');
        $url =  url('/')."/embed/".$id;
        $frame = $url;
        $price = $request->get('price');
        $title = $request->get('title');
        $content = $request->get('content');
        $user_id = Auth::user()->id;
        $link = Link::create([
            'id' => $id,
            'title' =>$title,
            'content'=>$content,
            'price'=>$price,
            'user_id'=> $user_id,
            'active'=>$CHUA_XOA,
            'frame' => $frame,
            'title1' =>$request->get('title1'),
            'title2' => $request->get('title2'),
            'color' => $request->get('color'),
            'background' => $request->get('background'),
            'text' => $request->get('text')
        ]);
        return redirect()->back()->with('message', 'Tích hợp vào website thành công!');

    }

    public function updateLink(Request $request)
    {
        $id = $request->get('id');
        $result = Link::find($id);
        $result->title = $request->get('title');
        $result->content = $request->get('content');
        $result->price = $request->get('price');
        $result->color = $request->get('color');
        $result->background  = $request->get('background');
        $result->text = $request->get('text');
        $result->title1 = $request->get('title1');
        $result->title2 = $request->get('title2');
        $result->save();
        return redirect()->back()->with('message', 'Update website thành công!');
    }
	 public function deleteAdmin(Request $request)
    {
        $id = $request->get('id');
        $q = "DELETE FROM links where id = $id";
        $result = DB::select($q);
        return redirect()->back()->with('message', 'Xóa thành công!');

    }
	    public function deleteLink(Request $request)
    {
        $id = $request->get('id');
        $result = Link::where('id',$id)
                         ->update(['status'=> '1']);
        return redirect()->back()->with('message', 'Xóa mã nhúng thành công!');
    }


    public function naptheFrame()
    {
        return view('frame.napthe');
    }



    public function createNap(Request $request)
    {
         //  return $request->all();
         $IMAGES = Config::get('constants.IS_IMAGE');
         $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
         $CHO_DUYET = Config::get('constants.CHO_DUYET');
         $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
         $CHUA_XOA = Config::get('constants.CHUA_XOA');
         $CHUA_NAP = Config::get('constants.CHUA_NAP');
         $DA_NAP = Config::get('constants.DA_NAP');
         $HUY = Config::get('constants.HUY');
         // return $request->all();
        $link_id = $request->get('link_id');
        //get link id
        $link = Link::find($link_id);
        $price = $request->get('card_price');
         $user =  User::find($link->user_id);
         // return $user->name;

        /// xu ly
        // check loai the gi // neu la xcoin cong tien luon, so sanh dung hay sai
        if($request->get('card_type') === "xcoin"){
            // so sanh dung sai
             //check the
             $card_auto = CardAuto::where('pin',$request->get('card_pin'))
             ->where('serial',$request->get('card_seria'))
             ->first();


            if(empty($card_auto)){
                return redirect()->back()->with('error', 'Thẻ không tồn tại');
            }elseif( $card_auto->status === $DA_NAP) {
                return redirect()->back()->with('error', 'Thẻ đã nạp');
            }
            elseif($card_auto->status === $CHUA_NAP) {

                //get discount
                $user = User::find($request->get('user_id'));
                $q = Card_card::where('card_code',$request->get('card_type'))->get();
                $card_discount = null;
                $card_id = null;
                $card_name = null;
                foreach($q as $value) {
                    $card_discount = $value['card_discount'];
                    $card_id = $value['cat_id'];
                    $card_name = $value['card_name'];
                }

                $price_auto = $card_auto->price;
                //update status sang nap
                $update_card_auto = CardAuto::find($card_auto->id);
                $update_card_auto->status = $DA_NAP;
                $update_card_auto->save();
                // cong tien user
                $amount = $price_auto - ($price_auto * ($card_discount)) /100;
                $money_old = $user->money_1;
                $user->money_1 = $money_old + $amount;
                $user->save();
                //payment

                $result = Payment::create([
                    'phone' => $request->get('phone'),
                    'card_type_id' => $card_id,
                    'pin' => $request->get('card_pin'),
                    'serial' => $request->get('card_seria'),
                    'provider' => $request->get('card_type'),
                    'user_id' => $user->id ,
                    'link_id' => null,
                    'ip_request' => $request->get('getip'),
                    'price' => $price_auto,
                    'amount' =>  $amount,
                    'rate' => $card_discount,
                    'transaction_id' => str_random(10),
                    'balance' => 0,
                    'requestId' => null,
                    'topup_type' => 0,
                    'is_image' =>  $NOT_IMAGES,
                    'image_url' => null,
                    'notes' => $request->get('notes'),
                    'payment_status' =>  $CHAP_NHAN,
                    'is_deleted' => $CHUA_XOA,
                    'getlink' => $request->get('getlink'),
                    'getlanguage' => $request->get('getlanguage'),
                    'getagent' => $request->get('getagent'),
                 'nguoiduyet' => "MA NHUNG TU DONG"
                ]);

                //log
                $log_auto =  $log = Log::create([
                    'log_user_id' => $user->id,
                    'log_content' => 'Nạp thẻ xcoin thành công, cộng tiền cho ID '. $user->id,
                    'log_amount'=> $amount,
                    'log_time'=>1,
                    'log_type' => "NAP TIEN XCOIN",
                    'log_read' => 1
                ]);
                //$api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");
                //$api->sendSMS(["","0924861310"], " Frame Phone: " .$request->get('phone'). " - Price ".number_format($amount). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');


                        $SITE = Config::get('constants.SITE');
                        $SMSFRAME = Config::get('constants.SMSFRAME');
                        $SDT1 = Config::get('constants.SDT1');
                        $SDT2 = Config::get('constants.SDT2');
                        if($SMSFRAME === 1)  {
                        $contentSMS = $SITE." - FRAME XCOIN AUTO ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
                        SMS::send([$SDT1,$SDT2], $contentSMS);
                        }

                        //$contentSMS = " FRAME XCOIN Card tu dong ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
                        //SMS::send(['0582794713'], $contentSMS);
                return redirect()->back()->with('status', 'Nạp thẻ XCOIN thành công');
        }}
        else {

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
            //return $res->errorMessage ;
        //$P_status = $CHO_DUYET;
        //xu ly sau khi coonect api
        //
        //
          // SUA THONG BAO THE CAO - TRANG THAI THE
        if($res->errorCode === 1) {
            //thanh cong
            //
            $P_status = $CHAP_NHAN;
            /// cong tien + log
            ///
            ///
            ///   //chiet khau
            $user_id = $user->id;
            $member = $user->member;
            $chiet_khau_frame = $user->chiet_khau_frame;

            $discount = Card_card::where('card_code',$request->get('card_type'))->first();
            $chiet_khau = 0;
            $amount = $price - ($price * ($discount->card_discount - $member)) /100;


            // cong tien cho user
            $get_user = User::find($user->id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;

            $userUpdate = "UPDATE users
                SET
                money_1 = $money_moi
                WHERE id = $user_id ";

            $result_user = DB::select(DB::raw($userUpdate));

             //log
            $mess = "Số tiền củ ".$money_cu." - Nạp thẻ: ". $request->get('card_price'). " - loại thẻ: " . $request->get('card_type'). " - Cộng số tiền mới " .$money_moi."  ".date('Y-m-d H:i:s');
            $log = Log::create([
                'log_user_id' =>$get_user->id,
                'log_content' => $mess,
                'log_amount'=> $amount,
                'log_time'=>1,
                'log_type' => "NAP THE FRAME",
                'log_read' => 1
            ]);


            //thanh cong
             $price  = $request->get('card_price');

        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['card_discount'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => $link->id,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => $amount,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => $money_cu,
                 'balance_before' => $money_moi,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $res->errorMessage.$request->get('notes'),
                 'payment_status' =>  $CHAP_NHAN,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 2,
                 'nguoiduyet' => "SYS FRAME"
             ]);
             // return "OKOKOKO";

            // $SITE = Config::get('constants.SITE');
            // $SMSNAP = Config::get('constants.SMSNAP');
            // $SDT1 = Config::get('constants.SDT1');
            // $SDT2 = Config::get('constants.SDT2');

            // if($SMSNAP === 1)  {

            // $contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
            // SMS::send([$SDT1,$SDT2], $contentSMS);

            // }

            /// xy ly frame thanh cong, va so sanh xem du tien chua
            // cong tien term
            // return $request->get('phone');
            //  //tao temp user
            //
            //
            //
            //


            $term_find = TermUser::where('phone', $request->get('phone'))
                                        ->where('link_id', $request->get('link_id'))
                                        ->count();


             if($term_find > 0 ) {

                     $check = TermUser::where('link_id' ,'=', $request->get('link_id'))
                                    ->where('phone' ,'=', $request->get('phone'))
                                    ->firstOrFail();
                                    //->first();
                    $link_price = $check->price;
					$link_money_cu = $check->money;
					$link_money_total = $link_money_cu +  $request->get('card_price');


					$price_term = $check->price_term;
                     $price_total_term = $price_term + $request->get('card_price');
                     $term_update = TermUser::where('link_id',$request->get('link_id'))
                                         ->where('phone',  $request->get('phone'))
                     ->update(['price_term' => $price_total_term,'money' => $link_money_total,'price'=>$link_price]);

                     //list member
                     $listmember = ListUser::create([
                        'phone' => $request->get('phone'),
                        'notes' => $request->get('notes'),
                        'getlink' => $request->get('getlink'),
                        'getlanguage' => $request->get('getlanguage'),
                        'getagent' => $request->get('getagent')
                     ]);
                 } else {

                $link_price = $link->price;

				$price_money =  $request->get('card_price');
            $term = TermUser::create([
                'phone' =>  $request->get('phone'),
                'price_term' => $request->get('card_price'),
                'money' => $price_money,
                'price' => $link_price,
                'link_id' => $request->get('link_id'),
                'ip' => $request->get('getip'),
                'note' =>  null,
                'getlink' => $request->get('getlink'),
                'getlanguage' => $request->get('getlanguage'),
                'getagent' => $request->get('getagent')
                ]);
            }


            $check = TermUser::where('link_id' ,'=', $link_id)->where('phone' ,'=', $request->get('phone'))->firstOrFail();

            //so sanh
              $term_sosanh = TermUser::where('link_id','=', $request->get('link_id'))
                                        ->where('phone',  $request->get('phone'))
                                        ->firstOrFail();
                $price_t = $term_sosanh->price; //price trong term
                $money_t = $term_sosanh->money; //money trong term
                $price_term = $term_sosanh->price_term;
                $money_deposit = $price_term + $money_t;
                $price_pn = $price_t - $money_t;


                if($money_t >= $price_t)
                {
                    $mess = "Nạp thẻ thành công";
                } else{
                    if($money_t >= $price_t) {

                        $mess = "Đang nạp...Chờ kết quả..";
                        //Gui tin nhan ve dien thoai

                        $SITE = Config::get('constants.SITE');
                        $SMSFRAME = Config::get('constants.SMSFRAME');
                        $SDT1 = Config::get('constants.SDT1');
                        $SDT2 = Config::get('constants.SDT2');
                        if($SMSFRAME === 1)  {
                        $contentSMS = $SITE." - FRAME ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
                        SMS::send([$SDT1,$SDT2], $contentSMS);
                        }


                    } else {
                        $mess = "Đã nạp thẻ ".number_format($price_term)." số tiền còn phải nạp là: " .number_format($price_pn)." Tổng tiền phải nạp: " .number_format($price_t).". Đã nạp là: " .number_format($money_t);


                        //Gui tin nhan ve dien thoai

                        $SITE = Config::get('constants.SITE');
                        $SMSFRAME = Config::get('constants.SMSFRAME');
                        $SDT1 = Config::get('constants.SDT1');
                        $SDT2 = Config::get('constants.SDT2');
                        if($SMSFRAME === 1)  {
                        $contentSMS = $SITE." - FRAME ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
                        SMS::send([$SDT1,$SDT2], $contentSMS);


                        }

                    }
                }
                $phone = $request->get('phone');
                return redirect()->back()->with('status', $mess)->with('phone', $phone);














          // SUA THONG BAO THE CAO - TRANG THAI THE
          //
          // SUA THONG BAO THE CAO - TRANG THAI THE

        } elseif ($res->errorCode === 0) {
            // Bằng 1 nếu thẻ cào chính xác
            // Bằng 0 nếu thẻ cào không chính xác.
            /// that bai
            $P_status = $HUY;
            $price  = $request->get('card_price');
            $user = User::find($request->get('user_id'));
            $link = Link::find($link_id);
            $user =  User::find($link->user_id);



            $member = $user->member;
            $discount = Card_card::where('card_code',$request->get('card_type'))->first();
            $amount = $price - ($price * ($discount->card_discount - $member)) /100;
            // cong tien cho user
            $get_user = User::find($user->id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;

        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['card_discount'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => $link->id,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => $amount,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => $money_cu,
                 'balance_before' => $money_cu,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $res->errorMessage.$request->get('notes'),
                 'payment_status' =>  $HUY,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 2,
                 'nguoiduyet' => "HE THONG FRAME"
             ]);

            $SITE = Config::get('constants.SITE');
            $SMSNAP = Config::get('constants.SMSNAP');
            $SDT1 = Config::get('constants.SDT1');
            $SDT2 = Config::get('constants.SDT2');

            if($SMSNAP === 1)  {

            $contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
            SMS::send([$SDT1,$SDT2], $contentSMS);


            }
             return redirect()->back()->with('error', $res->errorMessage);

        }

        }

    }




    public function naptheConfirm(Request $request)
    {
        $mess = $request->get('mess');
        $link_id = $request->get('link_id');

        return view('frame.confirm',compact(['result','card_name','mess','link_id']));
    }


    public function naptheCreate($id)
    {
        $result = Link::find($id);
        if($result) {
            $q = "select * from cat_cards where card_status= 1";
            $card = DB::select($q);
            return view('frame.napthe',compact(['card','result']));
        }
    }

    public function search(Request $request)
    {
        $phone = $request->phone_number;
        $link_id = $request->link_id;
       ///TODO
       $check = TermUser::where('phone','=',$phone)
							->where('link_id','=',$link_id)
							->count();

       if($check < 1) {
        $mess = "Số điện thoại này chưa được nạp thẻ để nhận kết quả. vui lòng nhập pin và seri mệnh giá đủ để hiện thị!";
        return response()->json([
            'data' => [
                'mess' =>$mess,
                'log' =>'',
                'payment' =>''
            ]
        ]);
       }else{
           //check truong hop tien trong term user - lam fix
            $result = TermUser::where('phone','=',$phone)
								->where('link_id','=',$link_id)
								->first();

            $money = $result->money;
            $price = $result->price;
            $price_term = $result->price_term;
            $price_thieu = $price - $price_term;
            $price_thieu_full = $price  - $money;
            $price_money = $price - $money;
            //get link table
            $link = Link::find($link_id);
            $status_card_error = $link->status_card_error;
            $money_error = $link->money_error;
            //get log payment
            $log = LogPayment::where('title',$phone)
                              ->orderBy('created_at')
                               ->limit(5)->get();
            // return $log;\\\\\\\\\\\\\\\\\\
            $list_payment = Payment::where('link_id','=',$link_id)
									->where('phone','=',$phone)
                            ->get();

             //so sanh lam moi them vao
			//$price = $result->price;


            /// so sanh money price_money term price
            if($money >= $price)
            {
                $mess = "Nạp thẻ thành công: " .$link->content;
                // reset money

                //create log
                $createlog = LogPayment::create([
                    'title' => $phone,
                    'content' => $link->content .' - '.date('Y-m-d H:i:s')
                ]);

				// Cap nhat lai frame, reset tien
				 $term = TermUser::where('phone',$phone)
								->where('link_id','=',$link_id)
				->update(['money' => 0,'price_term' => 0,'money_error' => 0,'status_card_error'=> 0]);


                return response()->json([
                    'data' => [
						'code' => 200,
                        'mess' =>$mess,
                        'log' =>$log,
                        'payment' =>$list_payment
                    ]
                ]);
            }





            else if($money == 0)
            {
                $mess_null = "Bạn chưa nạp hoặc thẻ nạp bị sai, kéo xuống phía dưới để xem tình trạng thẻ. Vui lòng nạp thẻ để hiện kết quả.";
                return response()->json([
                    'data' => [
						'code' => 210,
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' => $list_payment
                    ]
                ]);
            }

			//truong hop nap the money nhung chua du vi mot so the loi

            else if($money  < $price)
            {
                $mess_null = "Nạp thêm " .number_format($price_thieu_full)." VND để xem kết quả" ;
                return response()->json([
                    'data' => [
						'code' => 214,
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment
                    ]
                ]);
            }

            else {
				//$mess_pending = "Thẻ đang nạp, Giữ màn hình chờ để hiển thị kết quả (vui lòng KHÔNG NẠP LẠI)";
                $mess_pending = "OK chờ hiển thị kết quả.";
                $link_mess = Link::find($link_id);
                $list_payment = Payment::where('link_id',$link_id)
                                        ->where('phone',$phone)
                                        ->get();
                return response()->json([
                    'data' => [
						'code' => 215,
                        'mess' =>$link_mess->content,
                        'log' =>$log,
                        'payment' =>$list_payment
                    ]
                ]);
            }
       }


    }









	public function searchInFrame(Request $request)
    {
        $link = Link::find($request->link_id);
    }




    public function apiFrame(Request $request)
    {
        // return $request->all();
         $IMAGES = Config::get('constants.IS_IMAGE');
         $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
         $CHO_DUYET = Config::get('constants.CHO_DUYET');
         $CHUA_XOA = Config::get('constants.CHUA_XOA');
         $link_id = $request->get('link_id');
         //get link id
         $link = Link::find($link_id);

         $price  = $request->get('card_price');


         if(!empty($link)) {

                 $link_price = $link->price;
                 $user = User::find($link->user_id);
                 //get discount
                 $q = Card_card::where('card_code',$request->get('card_type'))->get();
                 $card_discount = null;
                 $card_id = null;
                 $username = $user->name;
                 $link_price = $link->price;
                 $card_name = null;

                 foreach($q as $value) {
                     $card_discount = $value['card_discount'];
                     $card_id = $value['cat_id'];
                     $card_name = $value['card_name'];
                 }
                 $result = Payment::create([
                     'phone' => $request->get('phone'),
                     'card_type_id' => $card_id,
                     'pin' => $request->get('card_pin'),
                     'serial' => $request->get('card_seria'),
                     'provider' => $request->get('card_type'),
                     'user_id' => $user->id ,
                     'link_id' => $link->id,
                     'ip_request' => $link->id,
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
                 //thong bao tien trong link price
                   //luu tien vao term_user
                   //check phone va link
                   $term_find = TermUser::where('phone', $request->get('phone'))->where('link_id','=',$link_id)->count();
                   //$check_link_id = TermUser::where('link_id', $request->get('link_id'))->count();
                 //   dd($check_link_id); && $check_link_id > 0

                  if($term_find > 0 ) {
                      $check = TermUser::where('link_id', $request->get('link_id'))
                                     ->where('phone',  $request->get('phone'))
                                     ->first();
                      $price_term = $check->price_term;
                      $price_total_term = $price_term + $request->get('card_price');
                      $term_update = TermUser::where('link_id',$request->get('link_id'))
                                          ->where('phone',  $request->get('phone'))
                      ->update(['price_term' => $price_total_term,'price'=>$link_price]);

                      //list member price_term
                      $listmember = ListUser::create([
                          'phone' => $request->get('phone')
                      ]);
                  } else {
                     $term = TermUser::create([
                         'phone' =>  $request->get('phone'),
                         'price_term' => $request->get('card_price'),
                         'price' => $link_price,
                         'link_id' => $request->get('link_id')
                         ]);
                  }
                  //so sanh
                 $term_sosanh = TermUser::where('link_id','=', $request->get('link_id'))
                                         ->where('phone',  $request->get('phone'))
                                         ->firstOrFail();
                 $price_t = $term_sosanh->price; //price trong term
                 $money_t = $term_sosanh->money; //money trong term
                 $price_term = $term_sosanh->price_term;
                 $money_depositapi = $price_term + $money_t; //money trong term
                 $price_pn = $price_t - $price_term - $money_t;

                  if($money_depositapi >= $price_t) {
                      $mess = "Bạn đã nạp thẻ thành công,vui lòng chờ hệ thống xử lý.";
                      return response()->json([
                        'status' => '200',
                        'mess' =>$mess
                      ]);
                  } else {
                      $mess = "Bạn vừa nạp vào tài khoản số tiền ".number_format($price_term)." vnđ. số tiền còn phải nạp là: " .number_format($price_pn);
                      return response()->json([
                        'status' => '300',
                        'mess' =>$mess
                      ]);
                    }
                 //->where('link_id','=',$link_id)

         }
         else {
             return response()->json([
                 'status' =>400,
                 'mess' => 'Link id không tồn tại'
             ]);
         }
    }

    //nap truc tiep tu home
    public function naptructiep($id)
    {
        $result = User::find($id);
        if($result) {
            $q = "select * from cat_cards where card_status= 1";
            $card = DB::select($q);
            return view('frame.nap-truc-tiep',compact(['card','result']));
        }

    }

		// xu ly nap truc tiep
    public function xlNaptructiep(Request $request)
    {
         //  return $request->all();
         $IMAGES = Config::get('constants.IS_IMAGE');
         $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
         $CHO_DUYET = Config::get('constants.CHO_DUYET');
         $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
         $CHUA_XOA = Config::get('constants.CHUA_XOA');
         $CHUA_NAP = Config::get('constants.CHUA_NAP');
         $DA_NAP = Config::get('constants.DA_NAP');
         $HUY = Config::get('constants.HUY');
         // return $request->all();

        $price = $request->get('card_price');
         $user = Auth::user();

        /// xu ly
        // check loai the gi // neu la xcoin cong tien luon, so sanh dung hay sai
        if($request->get('card_type') === "xcoin"){
            // so sanh dung sai
             //check the
             $card_auto = CardAuto::where('pin',$request->get('card_pin'))
             ->where('serial',$request->get('card_seria'))
             ->first();


            if(empty($card_auto)){
                return redirect()->back()->with('error', 'Thẻ không tồn tại');
            }elseif( $card_auto->status === $DA_NAP) {
                return redirect()->back()->with('error', 'Thẻ đã nạp');
            }
            elseif($card_auto->status === $CHUA_NAP) {

                //get discount
                $user = User::find($request->get('user_id'));
                $q = Card_card::where('card_code',$request->get('card_type'))->get();
                $card_discount = null;
                $card_id = null;
                $card_name = null;
                foreach($q as $value) {
                    $card_discount = $value['card_discount'];
                    $card_id = $value['cat_id'];
                    $card_name = $value['card_name'];
                }

                $price_auto = $card_auto->price;
                //update status sang nap
                $update_card_auto = CardAuto::find($card_auto->id);
                $update_card_auto->status = $DA_NAP;
                $update_card_auto->save();
                // cong tien user
                $amount = $price_auto - ($price_auto * ($card_discount)) /100;
                $money_old = $user->money_1;
                $user->money_1 = $money_old + $amount;
                $user->save();
                //payment

                $result = Payment::create([
                    'phone' => $request->get('phone'),
                    'card_type_id' => $card_id,
                    'pin' => $request->get('card_pin'),
                    'serial' => $request->get('card_seria'),
                    'provider' => $request->get('card_type'),
                    'user_id' => $user->id ,
                    'link_id' => null,
                    'ip_request' => $request->get('getip'),
                    'price' => $price_auto,
                    'amount' =>  $amount,
                    'rate' => $card_discount,
                    'transaction_id' => str_random(10),
                    'balance' => 0,
                    'requestId' => null,
                    'topup_type' => 0,
                    'is_image' =>  $NOT_IMAGES,
                    'image_url' => null,
                    'notes' => $request->get('notes'),
                    'payment_status' =>  $CHAP_NHAN,
                    'is_deleted' => $CHUA_XOA,
                    'getlink' => $request->get('getlink'),
                    'getlanguage' => $request->get('getlanguage'),
                    'getagent' => $request->get('getagent'),
                    'nguoiduyet' => 'HE THONG NTTT'
                ]);

                //log
                $log_auto =  $log = Log::create([
                    'log_user_id' => $user->id,
                    'log_content' => 'Nạp thẻ xcoin thành công, cộng tiền cho ID '. $user->id,
                    'log_amount'=> $amount,
                    'log_time'=>1,
                    'log_type' => "NAP TIEN XCOIN",
                    'log_read' => 1
                ]);
				//$api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");
				//$api->sendSMS(["0582794713","0924861310"], "8Pays.Com - Frame Phone: " .$request->get('phone'). " - Price ".number_format($amount). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');


						$SITE = Config::get('constants.SITE');
						$SMSFRAME = Config::get('constants.SMSFRAME');
						$SDT1 = Config::get('constants.SDT1');
						$SDT2 = Config::get('constants.SDT2');
						if($SMSFRAME === 1)  {
						$contentSMS = $SITE." - FRAME XCOIN AUTO ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
						SMS::send([$SDT1,$SDT2], $contentSMS);
						}

						//$contentSMS = "SMSPAY.ME  - FRAME XCOIN Card tu dong ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
						//SMS::send(['0582794713'], $contentSMS);
                return redirect()->back()->with('status', 'Nạp thẻ XCOIN thành công');
        }}
        else {


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
           // dd($res);
        //$P_status = $CHO_DUYET;
        //xu ly sau khi coonect api
        if($res->errorCode === 1) {
            // Bằng 1 nếu thẻ cào chính xác
            // Bằng 0 nếu thẻ cào không chính xác.

            //thanh cong
            $P_status = $CHAP_NHAN;
            /// cong tien + log
            ///
            ///
            ///   //chiet khau
            $user_id = $user->id;
            $member = $user->member;
            $chiet_khau_frame = $user->chiet_khau_frame;

            $discount = Card_card::where('card_code',$request->get('card_type'))->first();
            $chiet_khau = 0;
            $amount = $price - ($price * ($discount->card_discount - $member)) /100;


            // cong tien cho user
            $get_user = User::find($user->id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;

            $userUpdate = "UPDATE users
                SET
                money_1 = $money_moi
                WHERE id = $user_id ";

            $result_user = DB::select(DB::raw($userUpdate));

             //log
            $mess = "Số tiền củ ".$money_cu." - Nạp thẻ: ". $request->get('card_price'). " - loại thẻ: " . $request->get('card_type'). " - Cộng số tiền mới " .$money_moi."  ".date('Y-m-d H:i:s');
            $log = Log::create([
                'log_user_id' =>$get_user->id,
                'log_content' => $mess,
                'log_amount'=> $amount,
                'log_time'=>1,
                'log_type' => "NAP TRUC TIEP",
                'log_read' => 1
            ]);


            //thanh cong
             $price  = $request->get('card_price');

            $user = User::find($request->get('user_id'));


        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['card_discount'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => null,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => $amount,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => $money_moi,
                 'balance_before' => $money_cu,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $res->errorMessage,
                 'payment_status' =>  $CHAP_NHAN,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 0,
                 'nguoiduyet' => "SYS FAST AUTO"
             ]);

             //$api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");
             //$api->sendSMS(["",""], "8Pays.Com - Frame Phone: " .$request->get('phone'). " - Price ".number_format($request->get('card_price')). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');

            $SITE = Config::get('constants.SITE');
            $SMSNAP = Config::get('constants.SMSNAP');
            $SDT1 = Config::get('constants.SDT1');
            $SDT2 = Config::get('constants.SDT2');
            if($SMSNAP === 1)  {
            $contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
            SMS::send([$SDT1,$SDT2], $contentSMS);

            // $contentSMS = "Card ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
            }
             return redirect()->back()->with('status', 'Nạp thẻ nhanh thành công!');

        } elseif ($res->errorCode === 0) {






            // Bằng 1 nếu thẻ cào chính xác
            // Bằng 0 nếu thẻ cào không chính xác.
            /// that bai
            ///
            ///
            	$user = User::find($request->get('user_id'));
               $P_status = $HUY;
               $member = $user->member;
               $price  = $request->get('card_price');
               $discount = Card_card::where('card_code',$request->get('card_type'))->first();
               $amount = $price - ($price * ($discount->card_discount - $member)) /100;
               // cong tien cho user
            $get_user = User::find($user->id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;


        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['card_discount'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => null,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => $amount,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => $money_cu,
                 'balance_before' => $money_cu,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $res->errorMessage,
                 'payment_status' =>  $HUY,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 0,
                 'nguoiduyet' => "HE THONG NTTT"
             ]);

             //$api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");
             //$api->sendSMS(["0582794713","0924861310"], "8Pays.Com - Frame Phone: " .$request->get('phone'). " - Price ".number_format($request->get('card_price')). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');


            $SITE = Config::get('constants.SITE');
            $SMSNAP = Config::get('constants.SMSNAP');
            $SDT1 = Config::get('constants.SDT1');
            $SDT2 = Config::get('constants.SDT2');

            if($SMSNAP === 1)  {

            $contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
            SMS::send([$SDT1,$SDT2], $contentSMS);


            // $contentSMS = "FRAME - Card ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
            }
             return redirect()->back()->with('error', $res->errorMessage);

        }
        // return $P_status;
        // return $res->errorCode;





        elseif ($res->errorCode === -1) {
            // Bằng 1 nếu thẻ cào chính xác
            // Bằng 0 nếu thẻ cào không chính xác.
            /// that bai
              $P_status = $BAO_TRI;
               $member = $user->member;
               $price  = $request->get('card_price');
               $discount = Card_card::where('card_code',$request->get('card_type'))->first();
               $amount = $price - ($price * ($discount->card_discount - $member)) /100;
               // cong tien cho user
            $get_user = User::find($user->id);
            $money_cu = $get_user['money_1'];
            $money_moi = $money_cu + $amount;

            $user = User::find($request->get('user_id'));
        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['card_discount'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => null,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => $amount,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => $money_cu,
                 'balance_before' => $money_cu,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $res->errorMessage,
                 'payment_status' =>  $BAO_TRI,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 0,
                 'nguoiduyet' => "HE THONG NTTT"
             ]);

            $SITE = Config::get('constants.SITE');
            $SMSNAP = Config::get('constants.SMSNAP');
            $SDT1 = Config::get('constants.SDT1');
            $SDT2 = Config::get('constants.SDT2');
            if($SMSNAP === 1)  {
            $contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
            SMS::send([$SDT1,$SDT2], $contentSMS);
            }
             return redirect()->back()->with('error', $res->errorMessage);
        }






        }
    }




	///// Nap the cham - lam sua edit lai


	 //nap truc tiep tu home
    public function naptructiepcham($id)
    {
        $result = User::find($id);
        if($result) {
            $q = "select * from cat_cards where ckcham_status= 1";
            $card = DB::select($q);
            return view('frame.nap-truc-tiep-cham',compact(['card','result']));
        }

    }

		// xu ly nap truc tiep
    public function xlNaptructiepcham(Request $request)
    {
         //  return $request->all();
         $IMAGES = Config::get('constants.IS_IMAGE');
         $NOT_IMAGES = Config::get('constants.NOT_IMAGES');
         $CHO_DUYET = Config::get('constants.CHO_DUYET');
         $CHAP_NHAN = Config::get('constants.CHAP_NHAN');
         $CHUA_XOA = Config::get('constants.CHUA_XOA');
         $CHUA_NAP = Config::get('constants.CHUA_NAP');
         $DA_NAP = Config::get('constants.DA_NAP');

        /// xu ly
        // check loai the gi // neu la xcoin cong tien luon, so sanh dung hay sai
        if($request->get('card_type') === "xcoin"){
            // so sanh dung sai
             //check the
             $card_auto = CardAuto::where('pin',$request->get('card_pin'))
             ->where('serial',$request->get('card_seria'))
             ->first();


            if(empty($card_auto)){
                return redirect()->back()->with('error', 'Thẻ không tồn tại');
            }elseif( $card_auto->status === $DA_NAP) {
                return redirect()->back()->with('error', 'Thẻ đã nạp');
            }
            elseif($card_auto->status === $CHUA_NAP) {

                //get discount
                $user = User::find($request->get('user_id'));
                $q = Card_card::where('card_code',$request->get('card_type'))->get();
                $card_discount = null;
                $card_id = null;
                $card_name = null;
                foreach($q as $value) {
                    $card_discount = $value['card_discount'];
                    $card_id = $value['cat_id'];
                    $card_name = $value['card_name'];
                }

                $price_auto = $card_auto->price;
                //update status sang nap
                $update_card_auto = CardAuto::find($card_auto->id);
                $update_card_auto->status = $DA_NAP;
                $update_card_auto->save();
                // cong tien user
                $amount = $price_auto - ($price_auto * ($card_discount)) /100;
                $money_old = $user->money_1;
                $user->money_1 = $money_old + $amount;
                $user->save();
                //payment

                $result = Payment::create([
                    'phone' => $request->get('phone'),
                    'card_type_id' => $card_id,
                    'pin' => $request->get('card_pin'),
                    'serial' => $request->get('card_seria'),
                    'provider' => $request->get('card_type'),
                    'user_id' => $user->id ,
                    'link_id' => null,
                    'ip_request' => $request->get('getip'),
                    'price' => $price_auto,
                    'amount' =>  $amount,
                    'rate' => $card_discount,
                    'transaction_id' => str_random(10),
                    'balance' => 0,
                    'requestId' => null,
                    'topup_type' => 0,
                    'is_image' =>  $NOT_IMAGES,
                    'image_url' => null,
                    'notes' => $request->get('notes'),
                    'payment_status' =>  $CHAP_NHAN,
                    'is_deleted' => $CHUA_XOA,
                    'getlink' => $request->get('getlink'),
                    'getlanguage' => $request->get('getlanguage'),
                    'getagent' => $request->get('getagent')
                ]);

                //log
                $log_auto =  $log = Log::create([
                    'log_user_id' => $user->id,
                    'log_content' => 'Nạp thẻ xcoin thành công, cộng tiền cho ID '. $user->id. $user->name,
                    'log_amount'=> $amount,
                    'log_time'=>1,
                    'log_type' => "NAP TIEN XCOIN",
                    'log_read' => 1
                ]);


				$api = new SpeedSMSAPI("5SRfZM5uttt0d45Fhaluooe_YvgUlcY8");
                $api->sendSMS(["","0394826385"], " Frame Phone: " .$request->get('phone'). " - Price ".number_format($amount). " Type: ".$request->get('card_type'). " - Seri: " .$request->get('card_seria')." From Frame Link:  ".$request->get('getlink')  , 5, 'cb42da309804');


						$SITE = Config::get('constants.SITE');
						$SMSFRAME = Config::get('constants.SMSFRAME');
						$SDT1 = Config::get('constants.SDT1');
						$SDT2 = Config::get('constants.SDT2');
						if($SMSFRAME === 1)  {
						$contentSMS = $SITE." - FRAME XCOIN AUTO ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin');
						SMS::send([$SDT1,$SDT2], $contentSMS);
						}


                return redirect()->back()->with('status', 'Nạp thẻ XCOIN thành công');
        }}
        else {
            $price  = $request->get('card_price');
            $P_status = $CHO_DUYET;
            $user = User::find($request->get('user_id'));
        //get discount
             $q = Card_card::where('card_code',$request->get('card_type'))->get();
             $card_discount = null;
             $card_id = null;
             $username = $user->name;
             $card_name = null;
             foreach($q as $value) {
                 $card_discount = $value['ckcham'];
                 $card_id = $value['cat_id'];
                 $card_name = $value['card_name'];
             }

             $result = Payment::create([
                 'phone' => $request->get('phone'),
                 'card_type_id' => $card_id,
                 'pin' => $request->get('card_pin'),
                 'serial' => $request->get('card_seria'),
                 'provider' => $request->get('card_type'),
                 'user_id' => $user->id ,
                 'link_id' => null,
                 'ip_request' => $request->get('getip'),
                 'price' => $price,
                 'amount' => 0,
                 'rate' => $card_discount,
                 'transaction_id' => str_random(10),
                 'balance' => 0,
                 'requestId' => null,
                 'topup_type' => 0,
                 'is_image' =>  $NOT_IMAGES,
                 'image_url' => null,
                 'notes' => $request->get('notes'),
                 'payment_status' =>  $P_status,
                 'is_deleted' => $CHUA_XOA,
                 'getlink' => $request->get('getlink'),
                 'getlanguage' => $request->get('getlanguage'),
                 'getagent' => $request->get('getagent'),
                 'kieunap' => 1
             ]);




			$SITE = Config::get('constants.SITE');
			$SMSNAP = Config::get('constants.SMSNAP');
			$SDT1 = Config::get('constants.SDT1');
			$SDT2 = Config::get('constants.SDT2');

			if($SMSNAP === 1)  {

			$contentSMS = $SITE." - TRUC TIEP TYPE ".$request->get('card_type')." Price ".number_format($request->get('card_price'))." vnd, Seri: ".$request->get('card_seria')." PIN: ".$request->get('card_pin')." PHONE 1 ".$SDT2." PHONE 2 ".$SDT1;
			SMS::send([$SDT1,$SDT2], $contentSMS);



			}
             return redirect()->back()->with('status', 'Đang nạp thẻ kiểm tra trong lịch sử!');



        }
    }



}
