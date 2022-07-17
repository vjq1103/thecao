<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Bank;
use App\User;
use App\Log;
use App\BankAccount;
use App\WithDraw;
use Config;
use Auth;
class RuttienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $result = WithDraw::where('user_id',$user)->get();
        return view('rut-tien.index',compact('result'));
    }

    //rut tien
    public function withDraw(Request $request)
    {
        $CHO_DUYET = Config::get('constants.CHO_DUYET');
        $PHI_RUT = Config::get('constants.PHI_RUT');
        
        $user = Auth::user()->id;
        $get_money_1 = Auth::user()->money_1;
        $username = Auth::user()->name;
        $get_tam_giu = Auth::user()->tam_giu;
 
        $password2 = Auth::user()->password2;
        $user_price = Auth::user()->money_1;
        $money_rut = $request->get('money_rut');

        $amount = $money_rut -  $PHI_RUT;  // tong tien bang so tien muon rut - phi rut

        if($user_price > $request->get('money_rut') &&  $get_money_1 > 110000)

            if($password2  == $request->get('password2_rut') && $user_price > $request->get('money_rut')) {
                $bank_id = $request->get('back_user');
                $RUT_TIEN = Config::get('constants.RUT_TIEN');
                $bank = BankAccount::find($bank_id);
                $bank_list = Bank::find($bank['bank_id']);
                //tien tru tai khoan 1 tien hien co - tien rut
                $money_update = $get_money_1 - $money_rut;
                // tien tam giu = tien tam giu hien co + tien rut
                $money_tam_giu = $get_tam_giu + $money_rut;
                $mess = "Trừ tiền tài khoản.$username. tạm giữ: .$money_rut.";
                // tru tien tai khoan
                
                $user_rut = User::find($user);
                $user_rut->money_1 = $money_update;
                $user_rut->tam_giu = $money_tam_giu;
                $user_rut->save();
                //log tru tien
                $log = Log::create([
                    'log_user_id'=>$user,
                    'log_content'=>$mess,
                    'log_amount'=>$money_update,
                    'log_type' => "RUT-TIEN",
                    'log_read' => $RUT_TIEN,
                    'log_time' =>0
                ]);
               
                // luu vao withdraw

                $result = WithDraw::create([
                    'user_id' => $user,
                    'bank_id'=> $bank['bank_id'],
                    'bank_name' => $bank_list['bank_name'],
                    'bank_branch' => $bank['bank_branch'],
                    'bank_account_id' => $bank['id'],
                    'bank_account_name' => $bank['account_name'],
                    'bank_account_number' => $bank['account_number'],
                    'amount' => $amount, // tong tien nay da tru phi, vd 110k - 10k phi, khi chuyen thi chuyen 100k thoi nhe :v
                    'withdraw_status'=> $CHO_DUYET
                ]);  
                return redirect()->back()->with('thanhcong', 'Gửi yêu cầu rút tiền thành công, vui lòng chờ xác nhận từ Admin!');

            } else {
                return redirect()->back()->with('error', 'Mật khẩu cấp 2 không đúng!');
            }
        else {
            return redirect()->back()->with('error', 'Số tiền trong tài khoản của bạn không đủ! Số tiền phải lớn hơn 110K');
        }    

    }

    public function bankList()
    {
        $bank = Bank::all();
        return response($bank);
    }
    
    // add tai khoan

    public function addAccount(Request $request)
    {
        $STATUS_ACTICE = Config::get('constants.STATUS_ACTICE');
        $province = Auth::user()->tinh;
        $result = BankAccount::create([
            'user_id' =>$request->get('user_id'),
            'bank_id' => $request->get('back_type'),
            'province_id'=> $province ,
            'bank_branch' => $request->get('chi_nhanh'),
            'account_name' => $request->get('account_name') ,
            'account_number' => $request->get('account_number'),
            'status' => $STATUS_ACTICE,
        ]);
        return redirect()->back()->with('message', 'Thêm tài khoản ngân hàng thành công!');

    }
    
    //onlye get bank
    public function getBank()
    {
       $user = Auth::user()->id;
        $result = DB::table('bank_account as back_c')
                    ->leftJoin('banks as b', 'back_c.bank_id', '=', 'b.id')  
                    ->select('back_c.id','b.bank_name')  
                    ->where('back_c.user_id','=',$user)
                    ->get();     
        return response($result);            
    }

    public function historyRutTien()
    {
        $user = Auth::user()->id;
        $result = WithDraw::where('user_id',$user);

    }
}
