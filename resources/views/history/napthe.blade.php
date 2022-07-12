@extends('master')
@section('title')
    Lịch sử nạp thẻ trong ngày hôm nay - sản lượng nạp thẻ hôm nay
@endsection
@section('content')
<div class="row" >
        <div class="col-md-12">
          <h4>Tra cứu nạp thẻ trong ngày </h4>
		  
		 
		  <div class="table-responsive">
		   
<div class="row">
	<div class="col-sm-2">Lọc dữ liệu:
		<input type="text" placeholder="Số Seri, Pin" class="form-control input-xs">
		</div>
		<div class="col-sm-2">Từ ngày: 
		  <input type="date" class="form-control input-xs">
		  
		  </div>
		<div class="col-sm-2">Đến ngày:  
		  <input type="date" class="form-control input-xs"></div>
		<div class="col-sm-2">Tình trạng:
			<select class="form-control input-xs">
				<option>Thành công</option>
				<option>Chờ xử lý</option>
				<option>Bị từ chối</option>
			</select>
		</div>
		<div class="col-sm-2">Nhà cung cấp:
			<select class="form-control input-xs">

				<option>Viettel</option>
				<option>Vinaphone</option>
				<option>Mobiphone</option>
				<option>Gate</option>
				<option>Vietnammobile</option>
			</select>
		</div>
		<div class="col-sm-2">
			<br>
				<button type="button" class="btn btn-primary">Tìm</button>
			</div>
		</div>
		<br/>
		
			<table class="table table-striped table-bordered table-hover">
                <thead>
                   

             
                    <tr>
                        <th>#</th> 
                        <th>Mã thẻ</th> 
                        <th>Seri</th> 
                        <th>Mệnh giá</th>
                        <th>Thời gian</th> 
                        <th>Ghi chú</th>                       
                        <th>Tình trạng</th>
                        <th>Thực nhận</th>
                        <th title="Số dư cuối">Số dư</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hsitory as $key=>$item)
                    <form action="{{ route('delete-card') }}" method="GET">
                        <input type="hidden" value="{{ $item->payment_id }}" name="id" id="id">
                        <tr>
                                <td>
                                    {{ $key++ }}

 
                                </td>  
							 
                                <td>
								@if($item->is_image == 0)  
                                        Ảnh thẻ
									<?php /*** <img src="{{ asset($item->image_url) }}" style="width:90px;" alt=""> ***/ ?>
                                        @else 
								{{ $item->pin }}										
                                        @endif	
									</td>


                                     <td>{{ $item->serial }}  
                                    </td>


                                
                                <td>{{ number_format($item->price) }} <br/><img src="/img/logo/{{ $item->card_name }}.png" style="height:20px;" alt=""> </td>
                               

                                 <td>{{ $item->created }}</td>
                                <td>
                                        @if($item->link_id > 0)  
                                         <span class="label label-danger">MN {{ $item->link_id }} </span>
                                        @else 
                                         <span class="label label-primary">Trực tiếp</span>
                                        @endif
                                        <span class="label label-primary" title="MGD tổng 12{{ $item->payment_id }} - Mã đơn giao dịch là: {{ $item->payment_id }} ">MGD: {{ $item->payment_id }}</span>
                                    </td>

                                <!--<td>{{ $item->transaction_id }}</td>-->
                                <td> 
                                        @switch($item->payment_status)
                                        @case(0)  
                                            <span class="label label-primary">Đã gửi</span>
                                        @break
                                        @case(1)
                                            <span class="label label-info">Đang nạp</span>
                                        @break
                                        @case(2)
                                            <span class="label label-success">Thành công</span>
                                        @break
                                        @case(3)
                                            <span class="label label-danger">Lỗi</span>
                                        @break
                                        @case(4)
                                            <span class="label label-danger">Thẻ sai</span>
                                        @break
                                        @case(5)
                                            <span class="label label-warning">Đang bảo trì</span>
                                        @break
                                    @endswitch
                                </td>
                                 <td>

                                @if($item->link_id > 0)  
                                <!--{{number_format($item->price - (($item->price * ($item->rate + $item->chiet_khau_frame))/100))}}  -->

                                {{number_format($item->price - (($item->price * $item->rate)/100))}}                                          
                                @else 
                                {{number_format($item->price - (($item->price * ($item->rate - $item->member))/100))}} 
                                @endif


                                <!--{{  number_format($item->price - (($item->price * ($item->rate - $item->level))/100)) }} đ-->
                                </td>
                                  <td title="Số dư trước đó:  {{ number_format($item->balance_before) }} vnđ">  @if($item->balance > 0) {{ number_format($item->balance) }}  @else  @endif<br/>
                               </td>
                                <td>
                                    @if($item->payment_status == 3)
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    @endif

                                </td>
                            </tr>
                        </form>
                    @endforeach        
                    
                </tbody>
            </table>
        <br>
         </div> 
		 </div>     
    </div> 
    <div style="margin-top:5%;color: red">Ghi chú: Thành công: thẻ nạp hoàn thành đã được hệ thống nạp và cộng tiền vào tài khoản của bạn.<br/>Lỗi: Thẻ nạp sai, sai mã thẻ, mệnh giá hoặc đã bị sử dụng, không được cộng tiền vào tài khoản<br/>Bảo Trì: Thẻ bạn nạp lên chưa được sử dụng, hệ thống chúng tôi bảo trì nạp thẻ mệnh giá loại thẻ này, vui lòng lưu lại thẻ, seri và pin và nạp lên hệ thống vào lúc khác.<br/>
         Lịch sử nạp thẻ trong ngày hôm nay - sản lượng nạp thẻ hôm nay<br/>
         Tra cứu nạp thẻ trong ngày <br/>
		 
		 menh gia : {{number_format($count_today_muathe->tong_tien_mua_the)}} <br/>
		 amount: {{number_format($count_today_amout->tong_amount)}}
      </div> 
    <div style="float: right;margin-top:5%"class="text-center">{{ $hsitory->links() }}</div>

@endsection