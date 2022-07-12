@extends('master')
@section('title')
    Dach Sách Mua Thẻ
@endsection
@section('content')




<style type="text/css">body {max-width:99%!important;}</style>
@if(Auth::user() && Auth::user()->is_Admin > 0)

    <div class="table-responsive">
	
	
	<table class="table table-striped table-bordered table-hover">
                <thead>
                   <th style="width: 15px;">ID</th>
				   <th>Name</td>
				   <th>SDT</td> 
				   <th>ID User </td>
				   <th>Ngày tạo </td>
				   <th> Cập nhật</td>
				   <th>IP </td>
				   <th>Ref </td>
				   <th>Agent </td>
				   <th>Language </td>
                </thead>
                <tbody>
				
				
				
        </tr>
        @foreach($result as $value)
        <tr>
		
            <td>{{$value->id  }}</td>
            <td>{{$value->name  }}</td>			
            <td>{{ $value->phone }}</td>
            <td></td> 
				   <td>{{$value->created_at  }} </td>
				   <td>{{$value->updated_at  }} </td>
				   <td>{{$value->ip  }} </td>
				   <td>{{$value->getlink  }} </td>
				   <td>{{$value->getagent  }} </td>
				   <td>{{$value->getlanguage  }} </td>
			
			
		
		
		
		     </tr>
                        </form>    
                    @endforeach
                    
                </tbody>
            </table>
            </div>
			
			  <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
			   @endif
			   
			   
			   


 
@endsection