@extends('master')
@section('title')
    Tra cứu các giao dịch gần đây
@endsection
@section('content')


<!-- Khai bao gom:
App tao 1 file: ListFrame.php , http 1 file  /home/admin/web/8pays.com/public_html/app/Http/Controllers:  ListFrameController.php


Tao duong dan: web.php	
	//list frame	
    Route::get('/list-frame','ListFrameController@index')->name('list_frame');
	
	-->
	
	

  

<h4>  Tra cứu các giao dịch gần đây</h4>
    <div class="table-responsive">
	<!---- -->
				   
<div class="row">
	<div class="col-sm-2">Dữ liệu:
		<input type="text" placeholder="Từ khóa" class="form-control input-xs">
		</div>
		<div class="col-sm-2">Từ ngày: 
		  <input type="date" class="form-control input-xs">
		  
		  </div>
		<div class="col-sm-2">Đến ngày:  
		  <input type="date" class="form-control input-xs"></div>
		<div class="col-sm-2">Tình trạng:
			<select class="form-control input-xs">
				<option>Thành công</option>
				<option>Chưa hoàn thành</option>
				<option>Bị từ chối</option>
			</select>
		</div>
		<div class="col-sm-2">Loại:
			<select class="form-control input-xs">

				<option>Thẻ cào</option>
				<option>Rút tiền</option>
				<option>Chuyền tiền</option>
				<option>Nạp tiền</option>
				<option>Mua thẻ</option>
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
                   <th style="width:15px;">#ID</th>
				   
				   <th> NỘI DUNG</th>
				   <th>SỐ TIỀN </th>
				   <th>LOẠI GD</th>  
				   <th> NGÀY TẠO</th>
					<th>CẬP NHẬT CUỐI</th> 
                </thead>
				
				
				
				
         <tbody>
				
				
			 
        @foreach($result as $value)
        <tr>
		 
            <td>{{$value->log_id  }}</td>		 
			 <td> {{$value->log_content  }}</td>
			 <td>{{ number_format($value->log_amount) }} VND </td> 
			 <td>{{$value->log_type  }} </td> 
			  <td> {{$value->created_at  }}</td>
			 <td>{{$value->updated_at  }} </td>
			
			
		
		
		
		     </tr>
                      
                    @endforeach
                    
                </tbody>
            </table> 
            </div> 
			 <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
			  
			 
@endsection