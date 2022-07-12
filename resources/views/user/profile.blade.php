@extends('master')
@section('title')
   User Account
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped ">
                        <thead>
                            <tr> 
                                <td>Tài khoản</td>  <td title="{{ Auth::user()->id }}">{{ Auth::user()->name }}</td> <tr></tr>
                                <td>Số điện thoại</th>  <td>{{ Auth::user()->phone_number }}</td> <tr></tr>
                                <td>Email</td>  <td>{{ Auth::user()->email }}</td><tr></tr>
                                <td>Số tiền</td>  <td>{{ number_format(Auth::user()->money_1) }} đ </td><tr></tr><tr></tr>
                                <td>Ngày tham gia</td><td>{{ Auth::user()->created_at }}</td><tr></tr>
                                <td>Đóng băng</td>   <td>{{ Auth::user()->tam_giu }}</td>
                            </tr>
                                 
                        </thead>
                        <tbody>
                            <tr> 
                               
                              
                               
                               
                             
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>    
    

    <br>
    <hr>
      
        
          <br>
            
        {{-- <div class="row">
                <div class="col-md-12" >
                    <h2>Lịch sử giao dịch</h2>
                    <table class="table table-striped "style="overflow-y: scroll">
                        <thead>
                            <tr>
                                    <th>ID</th>
                                    <th>Mã Pin</th>
                                    <th>Mã Seria</th>
                                    <th>Loại Thẻ</th>
                                    <th>Giá Tiên</th>
                                    <th>Người Nạp</th>
                                    <th>Ảnh</th>
                                    <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($result))
                                @foreach ($result as $value)
                                    <tr>
                                        <td>{{ $value->payment_id }}</td>
                                        <td>{{ $value->pin }}</td>
                                        <td>{{ $value->serial }}</td>
                                        <td>{{ $value->card_name }}</td>
                                        <td>{{ number_format($value->price) }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td> <img src="{{ asset($value->image_url) }}" style="width:150px;" alt=""></td>
                                        <td>
                                                @switch($value->payment_status)
                                                @case(0)  
                                                    <button class="btn btn-sm btn-primary">Chờ duyệt</button>
                                                @break
                                                @case(1)
                                                    <button class="btn  btn-sm btn-info">Đang xử lý</button>
                                                @break
                                                @case(2)
                                                    <button class="btn  btn-sm btn-success">Thành công</button>
                                                @break
                                                @case(3)
                                                    <button class="btn  btn-sm btn-danger">Hủy</button>
                                                @break
                                                @case(4)
                                                    <button class="btn  btn-sm btn-danger">Thẻ sai</button>
                                                @break
                                                @case(5)
                                                    <button class="btn  btn-sm btn-warning">Bảo trì</button>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
    </div>
     --}}
   
@endsection