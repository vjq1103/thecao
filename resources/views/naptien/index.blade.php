@extends('master')
@section('title')
    Nạp Tiền Vào Hệ Thống
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <h4>Nạp Tiền Tài Khoản</h4>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif


            <form action{{ route('nap-tien.nap') }} method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="username" value="{{ Auth::user()->name }}">


                <div class="form-group">
                    <label for="">Chọn tài khoản</label>
                    <select id="bank" class="form-control" name="cars">

                        @if(isset($settingBank))

                            @foreach($settingBank as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach

                        @endif
                    </select>

                    <p id="naptien"></p>
                </div>


                <div class="form-group">
                    <label for="">Số dư </label>
                    <input type="text" class="form-control" id="money_old" name="money_old"
                           value="{{ number_format(Auth::user()->money_1 )}} đ" readonly/>
                </div>


                <div class="form-group">
                    <label for="">Số tiền</label>
                    <input type="number" class="form-control" id="money_nap" name="money_nap" maxlength="10" required/>
                    <p id="naptien"></p>
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu giao dịch</label>
                    <input type="password" class="form-control" id="password2" name="password2" required/>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Nạp
                    Tiền vào tài khoản
                </button>
            </form>
            <br>

        </div>
        <div class="col-md-8">
            <h4>Lịch sử nạp tiền</h4>
            <div class="table-responsive">


                <!---- -->

                <div class="row">
                    <div class="col-sm-2">Truy vấn:
                        <input type="text" placeholder="Số tiền" class="form-control input-xs">
                    </div>
                    <div class="col-sm-2">Từ ngày:
                        <input type="date" class="form-control input-xs">

                    </div>
                    <div class="col-sm-2">Đến ngày:
                        <input type="date" class="form-control input-xs"></div>
                    <div class="col-sm-2">Tình trạng:
                        <select class="form-control input-xs">
                            <option>Đã nạp xong</option>
                            <option>Đang chờ</option>
                            <option>Chưa chuyển</option>
                            <option>Bị từ chối</option>
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
                    <tr>
                        <th>Mã số</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result as $value)
                        <tr>
                            <td>3{{ $value->id }}</td>
                            <td>{{ number_format($value->deposit_amount) }} đ</td>
                            <td>
                                @if($value->deposit_status == 0)
                                    <span class="label label-blue">Đang xử lí</span>
                                @else
                                    <span class="label label-success">Nạp Thành Công</span>

                                @endif
                            </td>
                            <td>
                                {{ $value->created_at }}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{ $result->links() }}
            </div>
        </div>
    </div>










    @include('setting_data.setting_data')





    <!------------ ---------------->


    <!-------------------- --------------------->


    <script>

        function commaSeparateNumber(val) {
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
            }
            return val;
        }

        $("#money_nap").focusout(function () {

            $('#naptien').html("").html(commaSeparateNumber($(this).val()) + "đ")
        });
    </script>
@endsection
