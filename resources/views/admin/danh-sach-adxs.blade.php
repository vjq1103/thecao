@extends('master')
@section('title')
    Dach Sách Frame
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
                   <th style="width: 15px;">ID</th>
				   <th>Name</td>
				   <th> Nội dung</td>
				   <th> Giá</td>
				   <th>ID User </td>
				   <th> Tình trạng</td>
				   <th>Ngày tạo </td>
				   <th>Time </td>
                </thead>
                <tbody>
        </tr>
        @foreach($result as $value)
        <tr>
		
            <td>{{$value->id  }}</td>
            <td>{{$value->name  }}</td>			
            <td>{{ $value->phone }} đ</td>
            <td>{{$value->email  }}</td>			
			  <th> {{$value->browser  }}</td>
				   <th>{{$value->ip  }} </td>
				   <th>{{$value->note  }} </td>
				   <th>{{$value->time  }} </td>			
		     </tr>
                        </form>    
                    @endforeach                    
                </tbody>
            </table>
            </div>
			<div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>

			   @endif
			 
@endsection