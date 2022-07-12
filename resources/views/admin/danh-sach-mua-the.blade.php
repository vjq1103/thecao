@extends('master')
@section('title')
    Dach Sách Mua Thẻ
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
            <table class="table table-sm table-bordered " style="overflow: visible">
                <thead>
                    <th>STT</th>
                    <th>NICKNAME</th>
                    <th>LOẠI</th>
                    <th>GIÁ</th>
                    <th>SỐ.LƯỢNG</th>
                    <th>TIỀN</th>
                    <th>T.THÁI</th>
                    <th>MÃ NẠP</th>
                    <th>SERIAL</th>
                    <th>NOTE</th>
                    <th>ADMIN</th>
                </thead>
                <tbody>
                    @foreach ($result as $value)
                        <form action="{{ route('admin.buy-card') }}" method="POST" id="form1">
                            @csrf
                            <input type="hidden" value="{{  $value->buy_id }}" name="buy_id" id="buy_id">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" value="{{  $value->card_amount }}" name="card_prices" id="card_prices">
                            <input type="hidden" name="money_1" id="money_1" value="{{ Auth::user()->money_1 }}">
                            <input type="hidden" name="tam_giu" id="tam_giu" value="{{ Auth::user()->tam_giu }}">
                            <tr>
                                <td>{{ $value->buy_id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->card_provider_name }} {{ $value->card_discount }} %</td>
                                <td>{{ number_format($value->card_prices) }} đ</td>
                                <td>{{ $value->card_qty }}</td>
                                <td>{{ number_format( $value->card_amount) }} đ</td>
                                <td> @if($value->status == 2)
                                        <span class="text-success">Chấp Nhận</span>
                                    @elseif($value->status == 3) 
                                        <span class="text-danger">Hủy</span>
                                    @else 
                                        <span class="text-info">Chờ</span>
                                    @endif
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="so_the"  value="{{ $value->card_pin }}" style="width:125px;"/>
                                </td>
                                <td>
                                    <input class="form-control" type="number"  name="serial" value="{{ $value->card_serial }}" style="width:125px;"/>
                                </td>
                                <td> <textarea class="form-control" style="width:125px; height:50px" name="note" id="" cols="30" rows="10">{{ $value->card_notes }}</textarea></td>
                                <td>
                                    @if($value->status == 2 || $value->status == 3)
                                        <button disabled class="btn btn-sm btn-success" style="width:100px; display:inline">Chấp nhận</button>
                                        <button disabled class="btn btn-sm btn-danger">Hủy</button>
                                    @elseif($value->status == 0)    
                                        <button  class="btn btn-sm btn-success" style="width:100px; display:inline" value="2" name="status">Chấp nhận</button>
                                        <button class="btn btn-sm btn-danger" value="3" name="status">Hủy</button>
                                    @endif
                                </td>
                            </tr>
                        </form>    
                    @endforeach
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div style="float:right;width:100%;text-align:right">  {{ $result->links() }}</div>
<script>
    
</script>
@endsection