@extends('master')
@section('title')
    Lịch sử nạp thẻ trong ngày
@endsection
@section('content')
<div class="row" >
        <div class="col-md-12">
          <h4>Tra cứu Lịch sử nạp thẻ </h4>
		  
		 
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
                        <th>##</th>
                        <th>Loại Thẻ</th>
                        <th>Mã - Seri</th> 
                        <th>Mệnh giá</th>
                        <th>Thực nhận</th>
                        <th>Thời gian</th>
                        <th>Phương thức</th> 
                        <th>Tình trạng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hsitorytody as $item)
                    
                        <tr>
                                
								<td>141{{ $item->payment_id }}</td>
								<td><img src="/img/logo/{{ $item->card_name }}.png" style="height:20px;" alt="">  </td>
                                <td>
								@if($item->is_image == 0)  
                                        Ảnh thẻ
									<?php /*** <img src="{{ asset($item->image_url) }}" style="width:90px;" alt=""> ***/ ?>
                                        @else 
								PIN: {{ $item->pin }}<br/>SERI: {{ $item->serial }}											
                                        @endif	
									</td>
                                
                                <td>{{ number_format($item->price) }} đ</td>
                                <td>

                                @if($item->link_id > 0)  

                                {{number_format($item->price - (($item->price * ($item->rate + $item->chiet_khau_frame))/100))}} đ                                         
                                @else 
                                {{number_format($item->price - (($item->price * ($item->rate - $item->member))/100))}} đ 
                                @endif


                                <!--{{  number_format($item->price - (($item->price * ($item->rate - $item->level))/100)) }} đ-->
                                </td>
                                <td>{{ $item->created }}</td>
                                <td>
                                        @if($item->link_id > 0)  
                                         <span class="label label-warning">Mã nhúng {{ $item->link_id }} </span>
                                        @else 
                                         <span class="label label-primary">Trực tiếp</span>
                                        @endif
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
                                            <span class="label label-danger">Không nạp được</span>
                                        @break
                                        @case(4)
                                            <span class="label label-danger">Thẻ sai</span>
                                        @break
                                        @case(5)
                                            <span class="label label-warning">Đang bảo trì</span>
                                        @break
                                    @endswitch
                                </td>
                                <t
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
    <div style="float: right;margin-top:5%"class="text-center">{{ $hsitorytody->links() }}</div>

@endsection