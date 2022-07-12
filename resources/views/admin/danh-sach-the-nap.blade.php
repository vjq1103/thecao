@extends('master')
@section('title')
    Dach Sách Thẻ Nạp
@endsection
@section('content')

<style type="text/css">body {max-width:99%!important;}</style>

    <div class="row">

        <div class="col-md-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>MÃ</th>
			                 	<!--<th>Mã Seria</th> -->
                                <th>THẺ</th>
                                <th>GIÁ</th>
                                <th>AD</th>
                                <th>DUYỆT/KIỂU</th>
                                <th>T.TRẠNG</th> 
                                <th>NG NẠP</th>                                 
                                <th>NGUỒN</th>
                                <th style="width:153px;">GHI CHÚ</th>
                                <th style="width:22px;">REF IP</th> 
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $value)
                                <form action="{{ route('admin.addcard') }}" method="post">
                                    @csrf
                                    <input name="payment_id" id="payment_id" type="hidden" value="{{ $value->payment_id }}">
                                    <input name="user_id" type="hidden" value="{{ $value->id }}">
                                    <input name="price" type="hidden" value="{{ $value->price }}">
                                    <input name="member" type="hidden" value="{{ $value->member }}">
                                    <input name="rate" type="hidden" value="{{ $value->rate }}">
                                    <input name="card_name" type="hidden" value="{{ $value->card_name }}">
                                    <input type="hidden" name="phone" value="{{ $value->phone }}">
                                    <input type="hidden" name="link_id" value="{{ $value->link_id }}">
                                    <input type="hidden" name="chiet_khau_frame" value="{{ $value->chiet_khau_frame }}">
                                <tr>
                                    <td>{{ $value->payment_id }}</td>
                                    <td>
									@if($value->is_image == 0)  
                                         <img src="{{ asset($value->image_url) }}" style="width:80px;" alt="">
                                        @else 

									Mã: {{ $value->pin }}<br/>
                                    Seri: <code>{{ $value->serial }}</code>											
                                        @endif
									
									</td>

                                    <td>
                                      <img src="/img/logo/{{ $value->card_name }}.png" height="28" alt=" {{ $value->card_name }}" title=" {{ $value->card_name }}" /> 

                                    </td>
                                    <td align="center"><span class="label label-kieu">{{ number_format($value->price) }}</span> 
									  <br/>
										@if($value->link_id > 0)

											{{number_format($value->price - (($value->price * ($value->rate + $value->chiet_khau_frame))/100))}}
                                        @else
											{{number_format($value->price - (($value->price * ($value->rate - $value->member))/100))}}
                                        @endif</td>

										<td>

                                        @if($value->payment_status == 0 || $value->payment_status == 5)
                                         <select @if($value->payment_status == 2 || $value->payment_status == 3 || $value->payment_status == 4) disabled @else @endif class="form-control" name="status" id="status" onchange="this.form.submit()">
                                            <option value="">Hành động</option>
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Chấp nhận</option>
                                            <option value="3">Hủy</option>
                                            <option value="4">Thẻ sai</option>
                                            <option value="5">Bảo trì</option>
                                            <!--<option value="6">Xóa thẻ</option>-->
                                        </select>
                                        @else

                                        @endif
										</td>
										
										<td align="center">
										 <span class="label label-duyet">{{ $value->nguoiduyet }}</span>
										 <br/>
                                            @switch($value->kieunap)
                                                @case(0)
                                                    <span class="label label-kieu">NẠP NHANH</span>
                                                @break
                                                @case(1)
                                                    <span class="label label-kieu">NẠP CHẬM</span>
                                                @break @case(2)
                                                    <span class="label label-kieu">NẠP FRAME</span>
                                                @break 
                                            @endswitch

                                    </td>
									
									 



                                   
										<td align="center">
                                            @switch($value->payment_status)
                                                @case(0)
                                                    <span class="label label-blue">Chờ duyệt</span>
                                                @break
                                                @case(1)
                                                    <span class="label label-info">Đang xử lý</span>
                                                @break
                                                @case(2)
                                                    <span class="label label-success">Thành công</span>
                                                @break
                                                @case(3)
                                                    <span class="label label-danger">Hủy</span>
                                                @break
                                                @case(4)
                                                    <span class="label label-danger">Thẻ sai</span>
                                                @break
                                                @case(5)
                                                    <span class="label label-warning">Bảo trì</span>
                                                @break
                                            @endswitch

                                    </td>
									



                                    <td><span class="label label-user">{{ $value->name }}</span><br/> <code>{{ $value->phone_number }}</code> <br/> <code>{{ number_format($value->money_1) }}</code> </td>
                                    <!--<td>
									@if($value->is_image == 0)
                                        <img src="{{ asset($value->image_url) }}" style="width:80px;" alt="">
									@else
                                        @endif
                                    </td> -->
                                    <td>
                                        @if($value->link_id > 0)
                                          <span class="label label-info">Mã nhúng {{ $value->link_id }}</span><br/> </span> <a href="/embed/{{ $value->link_id }}" title="{{ $value->link_id }}">Link Frame</a> <br/> {{ $value->phone }}
											  {{$value->content}}
                                        @else
                                         <span class="label label-success">Trực tiếp</span>
                                        @endif
										 <br/><code>{{ $value->transaction_id }}</code>
                                    </td>


                                    <td> {{ $value->created_at }} <br/>
									<span data-toggle="collapse" data-target="#demo">
									<?php echo substr($value->notes, 0, 20); ?></span>
									<div id="demo" class="collapse in"> {{ $value->notes }}  </div>

									</td>

									 <td>
									 <span data-toggle="collapse" data-target="#demo2">
									<?php echo substr($value->getlink, 6, 15); ?></span>
									<div id="demo2" class="collapse in"> {{ $value->getlink }}  </div>
									<br/>{{ $value->ip_request }}</td>

                                </tr>
                            </form>
                               @endforeach
                            </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>

    <script>

    </script>
@endsection
