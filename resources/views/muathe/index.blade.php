@extends('master')
@section('title')
    Mua Thẻ
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <h5>Mua thẻ cào</h5>
    <br>
   
    <form action="{{ route('mua-the.buy-card') }}" method="post" >
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="member" id="member" value="{{ Auth::user()->member }}">
            <input type="hidden" name="money_1" id="money_1" value="{{ Auth::user()->money_1 }}">
            <input type="hidden" name="tam_giu" id="tam_giu" value="{{ Auth::user()->tam_giu }}">
        <div class="form-group">
          <label for="formGroupExampleInput">Số dư trong tài khoản</label>
           <input class="form-control" readonly type="text" value="{{ number_format( Auth::user()->money_1) }} ₫">
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Loại thẻ</label>
            <select name="card_type" class="form-control" id="card_type" onchange="cardDiscount(this)"  required>
                @foreach($result as $key)
                    <option  value="{{ $key->card_code }}">{{ $key->card_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Mệnh giá</label>
            <select required class="form-control" name="card_price">
             <!-- <option value="10000">10.000&nbsp;₫</option>-->
              <option value="20000">20.000&nbsp;₫</option>
              <option value="50000">50.000&nbsp;₫</option>
              <option value="100000">100.000&nbsp;₫</option>
              <option value="200000">200.000&nbsp;₫</option>
              <option value="500000">500.000&nbsp;₫</option> 
           </select>
          </div>
        <div class="form-group" style="display:none">
          <label for="formGroupExampleInput2">Số lượng</label>
          <input required type="number" class="form-control"name="qty" id="qty" value="1" placeholder="Số lượng">
        </div>
       
        <button type="submit" class="btn-sm btn btn-primary">Mua thẻ</button>
      </form>
      <br>
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="panel panel-default panel-table">
        <h6>CHIẾT KHẤU MUA THẺ</h6>
         <div class="panel-body">
		 <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th>TT</th>
                     <th>Nhà mạng</th>
                     <th>Phí</th>
                     <th>Trạng thái</th>
                  </tr>
               </thead>
               <tbody class="no-border-x">
                 @foreach ($card as $value)
                    <tr>
                        <td>{{ $value->cat_id }}</td>
                        <td>{{ $value->card_name }}</td>
                        <td>{{ $value->card_discount_buy }} %</td>
                        <td>
                          @if($value->card_status == 1)
                            <span class="label label-success">Hoạt động</span>
                          @else 
                            <span class="label label-warning">Bảo trì</span>
                          @endif
                        </td>
                    </tr>
                 @endforeach
                 
               </tbody>
            </table>
         </div
		 </div>
      </div>
</div>
</div>
</div>
{{--  //history  --}}
<div class="row">
    <div class="col-md-12 col-xs-12">
        <h4>Lịch sử mua thẻ</h4>
        <div class="table-responsive">
		
		<!---- -->
				   
<div class="row">
	<div class="col-sm-2">Dữ liệu:
		<input type="text" placeholder="Số Seri, Pin" class="form-control input-xs">
		</div>
		<div class="col-sm-2">Từ ngày: 
		  <input type="date" class="form-control input-xs">
		  
		  </div>
		<div class="col-sm-2">Đến ngày:  
		  <input type="date" class="form-control input-xs"></div>
		<div class="col-sm-2">Tình trạng:
			<select class="form-control input-xs">
				<option>Thẻ mới mua</option>
				<option>Thành công</option>
				<option>Thẻ chưa hoàn thành</option>
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
				<!---- -->

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Loại Thẻ</th>
                    <th>Mệnh giá</th>
                    <th>Số lượng</th>
                    <th>Tiền</th>
                    <th>Pin</th>
                    <th>Serial</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buy as $value)
                    <tr>
                        <td>11{{ $value->id }}</td>
                        <td>{{ $value->card_provider_name }}</td>
                        <td>{{ $value->card_prices }}</td>
                        <td>{{ $value->card_qty }}</td>
                        <td>{{ number_format($value->card_amount) }} đ</td>
                        <td>{{ $value->card_pin }}</td>
                        <td>{{ $value->card_serial }}</td>
                        <td>
                                @if($value->status == 2)
                                <span class="label label-success">Hoàn thành</span>
                            @elseif($value->status == 3) 
                                <span class="label label-danger">Hủy</span>
                            @else 
                                <span class="label label-info">Đang lấy thẻ</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
        </div>
	 
			 <div style="float: right;margin-top:5%"class="text-center">{{ $buy->links() }}</div>
    </div>
</div>
@endsection