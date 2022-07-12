@extends('master')
@section('title')
  Rút Tiền
@endsection
@section('content')
<div class="row _padding">
        <div class="col-md-6">

                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
                @if(session()->has('thanhcong'))
                    <div class="alert alert-success">
                        {{ session()->get('thanhcong') }}
                    </div>
                @endif
                <h4>Rút tiền</h4>
                <form action="{{ route('withdraw') }}" method="POST">
                        @csrf
                        <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Số dư</label>
                            <input type="text"  disabled="true" class="form-control"  value="{{ number_format(Auth::user()->money_1) }} đ"/>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Số tiền</label>
                            <input type="number" class="form-control" name="money_rut" id="money_rut"  required placeholder="" /><p class="input-group-addon">VNĐ</p>
                            <p id="tienrut"></p>
                        </div>
                        <div class="form-group">
                                <label for="formGroupExampleInput">Chọn ngân hàng đã thêm</label>
                                <select class="form-control" name="back_user" id="back_user">
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Mật Khẩu Cấp 2</label>
                            <input type="password" class="form-control" name="password2_rut" id="password2_rut"  required />
                        </div>
                        <button type="submit" class="btn-sm btn btn-success">Rút Tiền</button>
                </form>
        </div>
        <div class="col-md-6">

                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
             @endif
             <h4>Thêm tài khoản ngân hàng</h4>
             <form action="{{ route('api.add-bank') }}" method="GET">
                    @csrf
                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Số Tài Khoản</label>
                        <input type="number" class="form-control" name="account_number" id="account_number"  required />
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tên Chủ Tài Khoản</label>
                        <input type="text" class="form-control" name="account_name" id="account_name"  required />
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Ngân hàng</label>
                        <select class="form-control" name="back_type" id="back_type" required>
                            <option value="">Chọn ngân hàng</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="formGroupExampleInput">Chi Nhánh (Ghi tỉnh)</label>
                            <input type="text" class="form-control" name="chi_nhanh" id="chi_nhanh"  required />
                        </div>
                    <button type="submit" class="btn-sm btn btn-success">Thêm Ngân Hàng</button>
            </form>
        </div>

     </div>
    <div class="row">




            <div class="col-md-12">
                    <h4>Lịch sử rút tiền</h4>
               <table class="table table-striped table-bordered table-hover">
                    <tr>
                            <th>ID</th>
                            <th>Số tiền thực nhận</th>
                            <th>Ngân hàng</th>
                            <th>Chi nhánh</th>
                            <th>Tên TK</th>
                            <th>Số TK</th>
                            <th>Thời gian</th>
                            <th>Số dư cuối</th>
                            <th>Cập nhật cuối</th>
                            <th>Trạng Thái</th>
                    </tr>
                    @foreach ($result as $value)
                        <tr>
                            <td>52{{ $value->widthraw_id }}</td>
                            <td>{{ number_format( $value->amount) }} đ</td>
                            <td>{{ $value->bank_name }}</td>
                            <td>{{ $value->bank_branch }}</td>
                            <td>{{ $value->bank_account_name }}</td>                            
                            <td>{{ $value->bank_account_number }}</td>

                            <td>{{ $value->created_at }}</td>
                            <td title="Số dư sau khi thay đổi {{ number_format($value->amount_before) }} đ">{{ number_format($value->amount_after) }}  </td>
                            <td>{{ $value->updated_at }}</td>

                            <td> @if($value->withdraw_status == 2)
                                    <span class="label label-success">Thành công</span>
                                @elseif($value->withdraw_status == 3)
                                    <span class="label label-danger">Hủy</span>
                                @else
                                    <span class="label label-info">Chờ</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

   
    <div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>

 <div style="margin-top:5%;color: red">  Ghi chú: Thành công: Chuyển tiền về tài khoản của bạn thành công.<br/>Hủy: Không thể chuyển tiền về tài khoản bạn do bảo trì ngân hàng hoặc nhập sai thông tin thẻ <br/>Bảo Trì: Chúng tôi tạm ngừng hoạt động chuyền khoản trong hệ thống để bảo trì.<br/>
      </div> 


 
    </div>
     <script>

        function commaSeparateNumber(val){
        while (/(\d+)(\d{3})/.test(val.toString())){
          val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        return val;
      }
    $("#money_rut").focusout(function(){
      
     $('#tienrut').html("").html(commaSeparateNumber($(this).val()) + " đ")
    });


            this.ListAllBank();
            this.getOnlyBank();

            //get all bank
            function ListAllBank() {
                var arr = [];
                $.ajax({
                    url: "{{ route('api.bank') }}",
                    type: "get",
                    dateType: "text",
                    success: function(result) {
                        var htmlResult = "";
                        Object.keys(result).forEach(function(key) {
                            var bank_name = result[key].bank_name;
                            var bank_id = result[key].id;
                            htmlResult += "<option value='"+bank_id+"'>" + bank_name +"</option>"
                        })
                        $("#back_type").append(htmlResult);
                    }
                });
            }
            //get only bank
            function getOnlyBank()
            {
                var arr = [];
                $.ajax({
                    url: "{{ route('api.get-bank') }}",
                    type: "get",
                    dateType: "text",
                    success: function(result) {
                        var htmlResult = "";
                        Object.keys(result).forEach(function(key) {
                            var bank_id = result[key].id;
                            var bank_name = result[key].bank_name;

                            htmlResult += "<option value='"+bank_id+"'>" + bank_name +" </option>"
                        })
                        $("#back_user").append(htmlResult);
                    }
                });
            }

        </script>
@endsection
