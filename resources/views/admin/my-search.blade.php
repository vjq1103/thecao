@extends('master')
@section('title')
    My search
@endsection
@section('content')

<style type="text/css">body {max-width:99%!important;}</style>
	<div class="container">
		<h4>Tra cứu thẻ</h4>
<div class="jumbotron" style="color:#535054;text-align:center;">			 
  Đây là mục tra cứu thẻ cào nhanh, nhập seri thẻ vào hộp rồi ấn tìm kiếm, thông tin về thẻ xcoin sẽ hiện ra cho bạn dễ dàng truy vấn.
</div>

			<div class="row">
				<div class="col-md-6">
                    <input type="text" name="searchID" id="searchID" class="form-control" placeholder="Search" value="" placeholder="Nhập số seri thẻ xcoin để tra cứu">
				</div>
				<div class="col-md-6">
					<button type="" class="btn btn-success" onclick="search()">TÌM KIẾM</button>
				</div>
			</div>


		<table class="table table-bordered">
			<tr>
				<th>ID</th>
				<th>SERI THẺ</th>
				<th>GIÁ</th>
				<th>NGƯỜI TẠO</th>
				<th>NGÀY TẠO</th>
                <th>CẬP NHẬT</th>
                <th>TRẠNG THÁI</th>
			</tr>
            <tbody id="datatable">

            </tbody>
        </table>
        <p id="mess"></p>
	</div>
    <script>
       function search()
       {
        var text =document.getElementById('searchID').value;
        console.log(text)
        $.ajax({
            url: "{{ route('serial-search') }}",
            data: {
                'searchID':text
            },
            dataType: "text",
            success: function(result) {
                var JSONObject  = JSON.parse(result)
                var dataResult  = JSONObject;
                var html = "";
                Object.keys(dataResult).forEach(function(key) {
                  var checkcode = dataResult.code;
                    console.log(checkcode)

                if(checkcode === 400){
                    $('#datatable').html("")
                    $('#mess').html("").html("Thẻ không tồn tại");
                }
                else {
                    var dataCode = dataResult.data;
                    dataCode.forEach(function(element) {

                          var status = element.status;
                          console.log(status)
                          checkstatus = "";
                          if(status === 0){
                              checkstatus = "Chưa sử dụng";
                          } else if(status === 1 ) {
                              checkstatus = "Đã sử dụng";
                          }
                          html = "<tr><td>123"+element.id+"</td><td>"+element.serial+"</td><td>"+element.price.toLocaleString()+"</td><td>"+element.name+"</td><td>"+element.created_at+"</td><td>"+element.updated_at+"</td><td>"+checkstatus+"</td></tr>"
                          $('#datatable').html("").append(html);
                    })
                }
            })}
          });
       }
    </script>
	
	
	
	<div class="jumbotron" style="color:#535054;text-align:center;">			 
  Kiểm tra thẻ cào viettel, kiểm tra seri thẻ cào vinaphone mobile nhanh nhất, kiểm tra bằng api hệ thống nhà mạng, kiểm tra thẻ cào bằng seri tại đây.
</div>
@endsection
