@extends('master')
@section('title')
    Dach Sách Rút Tiền
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
            <table class="table table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <th>USER</th>
                    <th>SỐ TIỀN</th>
                    <th>NGÂN HÀNG</th>
                    <th>CHI NHÁNH</th>
                    <th>SỐ TK</th>
                    <th>T.THÁI</th>
                    <th>ADMIN</th>
                </tr>
                @foreach ($result as $value)
                    <form action="{{ route('admin.withDraw') }}" method="POST">
                        @csrf
                        <input type="hidden" name="widthraw_id" id="widthraw_id" value="{{ $value->widthraw_id }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $value->user_id }}">
                        <input type="hidden" name="amount" id="amount" value="{{ $value->amount }}">
                        <tr>
                            <td>{{ $value->widthraw_id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->amount }}</td>
                            <td>{{ $value->bank_name }}</td>
                            <td>{{ $value->bank_branch }}</td>
                            <td>{{ $value->bank_account_number }}</td>
                            <td>
                                @if($value->withdraw_status == 2)
                                    <span class="label label-success">Thành Công</span>
                                @elseif($value->withdraw_status == 3) 
                                    <span class="label label-danger">Hủy</span>
                                @else 
                                    <span class="label label-info">Chờ</span>
                                @endif
                            </td>
                            <td>   
                                <select   name="status" id="status" onchange="this.form.submit();" >
                                    <option value="">Hành Động</option>
                                    <option value="2">Chấp Nhận</option>
                                    <option value="3">Hủy</option>
                                </select>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
                </div>
        </div>
        <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>

    </div>
    <script>
        // submit form
        function Callsubmit(){
            this.form.submit();
            $("#status").prop('disabled', true);
        }
    </script>
@endsection