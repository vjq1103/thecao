@extends('master')
@section('title')
    Dach Sách Temp User Phone
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
				   <th>Phone</td>
				   <th> Tiền tạm</td>
				   <th> Giá</td>
				   <th>Ghi chú</td>
				   <th>Ngày tạo </td>
				   <th>Cập nhật </td>
				   <th> Tiền đã duyệt</td>
				   <th> IDFR</td>
				   <th> Link frame</td>
				   <th> Tiền bi lỗi</td>
				   <th>Status card</td>
                </thead>
                <tbody>



        </tr>
        @foreach($result as $value)
        <tr>

            <td>{{$value->id  }}</td>
            <td>{{$value->phone  }}</td>
            <td>{{ number_format($value->price_term) }}</td>
            <td>{{number_format($value->price)  }}</td>

			  <th> {{$value->note  }}</td>
				   <td>{{$value->created_at  }} </td>
				   <td>{{$value->updated_at  }} </td>
				   <td>{{number_format($value->money)  }} </td>
				   <td>{{$value->link_id  }} </td>
				   <td>https://8pays.com/embed/{{$value->link_id  }}
                        <p>{{ $value->link_content }}</p>
                </td>
				   <td>{{ number_format($value->money_error)  }} </td>
				   <td>{{$value->status_card_error  }} </td>

		     </tr>
                        </form>
                    @endforeach

                </tbody>
            </table>
			 <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div> <br/><br/>

            </div>
			   @endif

@endsection
