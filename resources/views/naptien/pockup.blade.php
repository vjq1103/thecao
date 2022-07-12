@extends('master')
@section('title')
Hướng dẫn nạp tiền
@endsection
@section('content')
    <div class="row">
           
        <div class="col-md-12" style="margin:0 auto;padding:0" >
                <h4 class="text-center">Hướng dẫn nạp tiền</h4>
                <form action="{{ route('nap-tien.confirm') }}" method="GET">
                       <input type="hidden" value="{{ $id }}" name="id">
                       <input type="hidden" value="{{ $amount }}" name="amount">
                           <table class="table table-condensed table-striped">
                              <tbody>
                                 <tr>
                                    <td class="text-right">Số dư hiện tại:</td>
                                    <td style="width: 60%;">{{ number_format(Auth::user()->money_1) }}&nbsp;₫</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center" colspan="2">Vui lòng chuyển tiền và nhập nội dung gửi chính xác tới thông tin sau</td>
                                 </tr>
                                 <tr>
                                    <td class="text-right">Thông tin chuyển khoản:</td>
                                    <td>Ngân hàng: <strong>Techcombank - Hà Nội</strong> <br>Số tài khoản nhận: <strong>-----</strong> <br>Tên người hưởng: <strong>-----</strong> 
                                        <br>Số tiền gửi: <strong>{{ number_format($amount) }} đ</strong> <br>Nội dung gửi: <strong>
                                            NAP_{{ $amount }}_{{ Auth::user()->email }}</strong></td>
                                 </tr>
                                 <tr>
                                    <td class="text-right">Trạng thái:</td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td class="text-center" colspan="2">Sau khi chuyển khoản thành công theo thông tin trên, vui lòng bấm vào xác nhận dưới đây.</td>
                                 </tr>
                                 <tr>
                                    <td class="text-center" colspan="2">  <button type="submit" class="btn btn-primary">Xác nhận đã chuyển khoản</button> <button class="btn btn-default">Huỷ bỏ</button></td>
                                 </tr>
                              </tbody>
                           </table>
                </form>           
                       
        </div>
    </div>
@endsection