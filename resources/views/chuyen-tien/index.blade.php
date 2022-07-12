@extends('master')
@section('title')
   Chuyển tiền tới thành viên khác trong hệ thống - Yên Chi Triệu Lệ Dĩnh
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 _padding">
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
        <h4>Chuyển tiền</h4>
        <form action="{{ route('chuyen-tien') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group" style="display: none;">
                    <label for="formGroupExampleInput">Loại chuyển </label>
                    <select name="chuyen_tien" id="chuyen_tien" class="form-control" onclick="showChuyenTien(this)" required>
                        <option value="khac_tai_khoan" selected>Chuyển cho người dùng khác</option>
                        <!--<option value="cung_tai_khoan">Tài khoản chính -- -> Tài khoản phụ ( Lựa chọn phương thức chuyển tiền )</option>-->
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Số điện thoại người Nhận</label>
                    <input type="number" class="form-control" name="user_nhan_tien" id="user_nhan_tien"   />
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Số Tiền</label>
                    <input type="number" class="form-control" name="money_chuyentien" id="money_ct"  required />
                    <p id="tien"></p>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Mật Khẩu Giao Dịch</label>
                    <input type="password" class="form-control" name="password2" id="password2"  required />
                </div>
                <button type="submit" class="btn-sm btn btn-primary">CHUYỂN TIỀN</button>
    </form>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Loại chuyển</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody id="content">
        </tbody>
    </table>
</div>
<script>
    function showChuyenTien(selected){
        var type = selected.value;
        var khac_tk = "khac_tai_khoan";
        var cung_tk = "cung_tai_khoan";

        console.log(type)
        if(type == khac_tk) {
            $( "#user_nhan_tien" ).prop( "disabled", false );
        } else if(type == cung_tk) {
            $( "#user_nhan_tien" ).prop( "disabled", true );
        }
    }
    function commaSeparateNumber(val){
        while (/(\d+)(\d{3})/.test(val.toString())){
          val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        return val;
      }
    $("#money_ct").focusout(function(){
      
     $('#tien').html("").html(commaSeparateNumber($(this).val()) + "đ")
    });

    $.ajax({
        url: "{{ route('api.history-chuyen-tien') }}",
        type: "get",
        dateType: "text",
        success: function(result) {
            var htmlResult = "";
            Object.keys(result).forEach(function(key) {
                console.log(result)
                var log_content = result[key].log_content;
                var log_type = result[key].log_type;
                var log_id = result[key].log_id;
                var created_at = result[key].created_at
                htmlResult += "<tr><td>"+log_id+"</td><td>"+log_type+"</td><td>"+log_content+"</td><td>"+created_at+"</td><td>Thành Công</td></tr>"
            })
            $("#content").append(htmlResult);
        }
    });
</script>
@endsection