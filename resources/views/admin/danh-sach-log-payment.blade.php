@extends('master')
@section('title')
    Dach Sách Log Payment
@endsection
@section('content')

<style type="text/css">body {max-width:99%!important;}</style>

	

 
@if(Auth::user() && Auth::user()->is_Admin > 0)

    <div class="table-responsive">
	
	
	<table class="table table-striped table-bordered table-hover">
                <thead>
                   <th style="width: 15px;">ID</th>
				   <th>Tiêu đề </th>
				   <th> Nội dung</th>
				   <th>Ngày tạo </th>				   
				   <th> Cập nhật</th>
                </thead>
                <tbody>
				
				
				
        </tr>
        @foreach($result as $value)
        <tr>
		
            <td>{{$value->id }}</td>
            <td>{{$value->title }}</td>			
            <td>{{$value->content }}</td>
			 <td>{{$value->created_at }} </td>
			<td>{{$value->updated_at }} </td>
			</tr>
                        
                    @endforeach
                    
                </tbody>
            </table>
            </div>
			 <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
			   @endif
			 
@endsection