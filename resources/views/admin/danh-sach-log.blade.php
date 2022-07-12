@extends('master')
@section('title')
   Tra cứu các giao dịch
@endsection
@section('content')


<!-- Khai bao gom:
App tao 1 file: ListFrame.php , http 1 file  /home/admin/web/8pays.com/public_html/app/Http/Controllers:  ListFrameController.php


Tao duong dan: web.php	
	//list frame	
    Route::get('/list-frame','ListFrameController@index')->name('list_frame');
	
	-->
	
	

 

<style type="text/css">body {max-width:99%!important;}</style>
@if(Auth::user() && Auth::user()->is_Admin >= 0)

    <div class="table-responsive">
	
	
	<table class="table table-striped table-bordered table-hover">
                <thead>
                   <th style="width:15px;">ID</th>
				   <th>ID User</th>
				   <th> Kiểu</th>
				   <th> Nội dung</th>
				   <th>Số tiền </th>
				   <th> Thời gian</th>
				   <th>Loại log </th>
				   <th>Tình trạng log </th>
				   <th> Ngày tạo</th>
					<th>Update</th> 
                </thead>
				
				
				
				
         <tbody>
				
				
			 
        @foreach($result as $value)
        <tr>
		
            <td>{{$value->log_id  }}</td>
            <td>{{$value->log_user_id  }}</td>			
            <td>{{$value->log_receiver  }}</td>
			 <td> {{$value->log_content  }}</td>
			 <td>{{$value->log_amount  }} </td>
			 <td>{{$value->log_time  }} </td>
			 <td>{{$value->log_type  }} </td>
			 <td>{{$value->log_read  }} </td>
			  <td> {{$value->created_at  }}</td>
			 <td>{{$value->updated_at  }} </td>
			
			
		
		
		
		     </tr>
                      
                    @endforeach
                    
                </tbody>
            </table> 
            </div> 
			 <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
			   @endif
			 
@endsection