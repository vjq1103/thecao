<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $result = Link::where('user_id',$user_id) ->orderBy('created_at', 'desc')->get();
        return view('frame.index',compact(['result'])); 
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

    public function naptheFrame()
    {
        return view('frame.napthe');
    }

   

    public function createNap(Request $request)
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
                  $term_find = TermUser::where('phone', $request->get('phone'))->count();
                  $check_link_id = TermUser::where('link_id', $request->get('link_id'))->count();
                //   dd($check_link_id);

                 if($term_find > 0 && $check_link_id > 0) {
                     $check = TermUser::where('link_id', $request->get('link_id'))
                                    ->where('phone',  $request->get('phone'))   
                                    ->first();
                     $price_term = $check->price_term;
                     $price_total_term = $price_term + $request->get('card_price');
                     $term_update = TermUser::where('link_id',$request->get('link_id'))
                                         ->where('phone',  $request->get('phone'))
                     ->update(['price_term' => $price_total_term,'price'=>$link_price]);

                     //list member
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
                $price_term = $term_sosanh->price_term; 
                $price_pn = $price_t - $price_term;
               
                 if($price_term >= $price_t) {
                     $mess = "Bạn đã nạp thẻ thành công,vui lòng chờ hệ thống xử lý trong 5, 10 phút, nhập số điện thoại để hiện kết quả.";
 
                 } else {
                     $mess = "Bạn vừa nạp vào tài khoản số tiền ".number_format($price_term)." số tiền còn phải nạp là: " .number_format($price_pn);
                 }
                    
               
                // return $result;
                return redirect()->back()->with('status', $mess);
                // return redirect()->action(
                //     'FrameController@naptheConfirm', ['result'=>$result,'card_name' =>$card_name,'mess' =>$mess,'link_id'=>$link_id]
                // );
                 
            
        }
        return redirect()->back()->with('error', 'Frame id không tồn tại, vui lòng kiểm tra lại.');

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
       $check = TermUser::where('phone','=',$phone)->count();
       if($check < 1) {
        $mess = "Số điện thoại không tồn tại.";
        return response()->json([
            'data' => [
                'mess' =>$mess,
                'log' =>'',
                'payment' =>''
            ]
        ]);
       }else{
           
            $result = TermUser::where('phone','=',$phone)->first();
            $price = $result->price;
            $money = $result->money; 
            $price_term = $result->price_term;
            $price_thieu = $price - $price_term;
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
            $list_payment = Payment::where('link_id',$link_id)
                            ->where('phone',$phone)
                            ->get();
                           
            /// so sanh
            if($money >= $price) 
            {
                $mess = "Nạp thẻ thành công:  " .$link->content;
                // reset money
                $term = TermUser::where('phone',$phone)
                ->update(['money' => 0,'price_term' => 0,'money_error' => 0,'status_card_error'=> 0]);
                //create log
                $createlog = LogPayment::create([
                    'title' => $phone,
                    'content' => $link->content .date('Y-m-d H:i:s')
                ]);
                return response()->json([
                    'data' => [
                        'mess' =>$mess,
                        'log' =>$log,
                        'payment' =>$list_payment
                    ]
                ]);
            } 
            else if($price_term === 0 && $money === 0)
            {
                $mess_null = "Bạn chưa nạp thẻ nào, vui lòng nạp thẻ.";
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' => $list_payment 
                    ]
                ]);
            } 
            else if($price_term > 0 && $price_term  < $price && $money === 0)
            {
                $mess_null = "Bạn nạp thẻ chưa đủ tiền để hiển thị, vui lòng nạp thêm  " .number_format($price_thieu) ;
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment 
                    ]
                ]);
            } 
            else if($price_term > 0 && $price_term  < $price && $money > 0 && $status_card_error == 0)
            {
                $mess_null = "Vui lòng chờ thẻ đang được hệ thống xử lí  " ;
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment 
                    ]
                ]);
            } 
            else if($price_term == 0 && $money  < $price  && $money_error > 0)
            {
                $mess_null = "Bạn đang nạp thiếu tiền vui lòng nạp thêm " .number_format($price_thieu) ;
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment 
                    ]
                ]);
            }
            else if( $money > 0 && $money < $price  && $money_error > 0 && $status_card_error == 1 )
            {
                $mess_null = "Bạn nạp đang thiếu " .$price_money. " do có thẻ bị lỗi " ;
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment 
                    ]
                ]);
            } 
            

            else if( $money > 0 && $money < $price  && $money_error == 0)
            {
                $mess_null = "Bạn nạp đang thiếu " .$price_money ;
                return response()->json([
                    'data' => [
                        'mess' =>$mess_null,
                        'log' => $log,
                        'payment' =>  $list_payment 
                    ]
                ]);
            } 
            
            else {
                $mess_pending = "Thẻ đang được xử lý, vui lòng nhập lại số điện thoại, sau ít phút.";
                $list_payment = Payment::where('link_id',$link_id)
                                        ->where('phone',$phone)
                                        ->get();
                return response()->json([
                    'data' => [
                        'mess' =>$mess_pending,
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
}
