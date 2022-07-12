@extends('master')
@section('title')
   Tiền -  Dach Sách 
@endsection
@section('content')


<!-- Khai bao gom:
App tao 1 file: ListFrame.php , http 1 file  /home/admin/web/8pays.com/public_html/app/Http/Controllers:  ListFrameController.php


Tao duong dan: web.php	
	//list frame	
    Route::get('/list-frame','ListFrameController@index')->name('list_frame');
	
-->

<style type="text/css">body {max-width:99%!important;}</style>	
	

 
          @if(Auth::user() && Auth::user()->is_Admin > 0)

    <div class="table-responsive">
	
	
	<table class="table table-striped table-bordered table-hover">
                <thead>
						<th style="width:15px;">ID</th>
					<th>ID User</th>
						<th>Sdt</th>
                        <th>Email</th>
                        <th>Money</th>
                        <th>Tạm giữ</th>						
                        <th>Ngày</th>
                        <th>Role</th>
                        <th>AdminLV</th>
                        <th>Action</th>
						
                </thead>
				
				
				
				
         <tbody>
				
				
			 
        @foreach($result as $value)
        <tr>
		<td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->phone_number }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ number_format($value->money_1) }}  đ </td>
                            <td>{{ number_format($value->tam_giu) }}  đ</td>
                            <td>{{ $value->created_at }}</td>
                            <td>
                                @if($value->is_Admin === 1)
                                    <span>Admin</span>
                                @else 
                                    <span>Thành viên</span>
                                @endif    
                            </td>
                            <td>{{ $value->is_Admin }}</td>						
			
		
		
		
		     </tr>
                      
                    @endforeach
                    
                </tbody>
            </table> 
            </div> 
			 <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
			   @endif
			 
@endsection