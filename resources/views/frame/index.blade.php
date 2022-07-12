@extends('master')
@section('title')
    Tích hợp vào website
@endsection
@section('content')

<marquee width="100%" behavior="scroll" bgcolor="green" style="z-index:10000;margin:0;padding:0;position:fixed;bottom:0;left:0;right:0">  
        <span style="color:#fff">Trang nạp thẻ qua mã nhúng frame cho web, tích hợp API mã nhúng cho web game và shop bán hàng tự động 5 giây!</span>
    </marquee>

    <div class="row">
        <div class="col-md-12">
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
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <h4>Tích hợp mã nhúng cập nhật kết quả theo ngày</h4>
                    <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                </div>
                <div class="panel-body">
                    
					
					

					
					<style type="text/css">
					@media screen and (min-width: 0px) and (max-width: 1199px) {
  #my-content{ display: none; }  /* show it on smaller screen */
}
@media screen and (min-width: 1200px) and (max-width: 3024px) {
  #my-content{   }   /* hide it on larger screens */
}</style>
					
					
					<div class="table-responsive">
                    <table class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                            <tr> 
                                <th style="text-align:center">Tên mã nhúng</th>
                                <th style="text-align:center">Nội dung trả về</th>
                                <th style="text-align:center">Giá hiện thị</th>
                                <th style="text-align:center">Copy Mã </th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('frame.create') }}" method="POST">
                                @csrf
                                <tr> 
                                    <td class="number">
                                        <input type="text" class="form-control input-sm" name="title" placeholder="Nhập tiêu đề" required>
                                    </td>
                                    <td class="number">
                                        <input type="text" name="content" class="form-control input-sm" placeholder="Nội dung trả về khi nạp thẻ thành công" required>
                                    </td>
                                    <td class="number">
                                        <input type="number" name="price" class="form-control input-sm" placeholder="" required value="0">
                                    </td>                                    
                                    <td class="number">
                                        <button class="btn btn-primary btn-sm">Thực hiện</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
		<div class="table-responsive">
            <table class="table">
			<!-- 
            <table class="table table-striped table-bordered table-hover"> <table class="table table-sm table-bordered"> -->
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tiêu đề</th>	
                        <th>Nội dung</th>
                        <th>Giá</th>
                        <th>Frame</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
				 
                    @foreach ($result as $value)
                    <form action="{{ route('frame.updateLink') }}" method="GET">
                        <input type="hidden" value="{{ $value->id }}" name="id">
                        <tr>
                            <td><a href="{{ $value->frame }}">{{ $value->id }}</a></td>
                            <td><textarea class="form-control input-large" name="title" type="text">{{ $value->title }}</textarea></td>			
													
                            <td><textarea class="form-control input-large" name="content" type="text">{{ $value->content }}</textarea></td>
                            <td><textarea class="form-control input-sm" name="price" type="text">{{ $value->price}}</textarea><br/>{{ number_format($value->price) }}  vnd</td>							
                            <td><textarea class="form-control input-large">&lt;iframe src=&#039;{{ $value->frame }}&#039; style=&#039;width&#58;100% &#59; height&#58;480px&#039; frameborder=&#039;0&#039; marginwidth=&#039;0&#039; marginheight=&#039;0&#039; scrolling=&#039;yes&#039;&gt;&lt;/iframe&gt;</textarea></td>
                            <td><button class="btn-sm btn btn-primary">Cập nhật</button> </form>
							<a target="_blank" class="btn-sm btn btn-success" href="{{ $value->frame }}" target="_blank" title="Lấy link nạp">Link nạp</a>
							
							
							 
							
							<form action="{{ route('frame.deleteLink') }}" method="GET">
							<input type="hidden" value="{{ $value->id }}" name="id"><button class="btn-sm btn btn-danger">Xóa</button>  </form>
                    
							</td>
                        </tr>
                   
                    @endforeach
                   
                </tbody>
            </table>
			</div>
			<div style="float: right;margin-top:5%"class="text-center">{{ $result->links() }}</div>
        </div>
		
		<div>
                        <div role="alert" class="alert alert-contrast alert-primary alert-dismissible">
                            <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                            <div class="message">
						 
							<span data-toggle="collapse" data-target="#demo2">
									Nếu bạn chưa biết sử dụng mã nhúng vui lòng click vào đây để xem hướng dẫn dùng frame mã nhúng...ấn xem thêm để xem chi tiết..</span>
									<div id="demo2" class="collapse in">  <code>
								Muốn sửa kết quả cho ngày mai thì <strong>tìm tới mục #ID cần sửa ở chỗ nội dung hiện thị rồi sửa lại kết quả ngày mai rồi ấn cập nhật/sửa số để thay đổi thông tin</strong> hiện thị kết quả.
								<br>- Tiêu đề là tiêu đề số
                                <br>- Số tiền khi nhập là: 1 triệu thì ghi là: 1000000  - 100k thì ghi là: 100000. <strong> Lưu ý:  Số tiền thì ko bỏ dấu chấm dấu phẩy ví dụ: 100.000 hay 1,000,000 là sai sẽ không hiện thị đúng</strong>
                                <br>- Click chuột phải chọn tất cả nội dung trong ô copy mã nhúng chọn copy rồi dán vào trang web của bạn.
                                <br>- Tiêu đề 1 là tiêu đề hiện lên ở trên cùng của mã nhúng để mình ghi chú một điều gì đó. Tiêu đề 2 tượng tự nhưng hiện thị ở cuối của mã nhúng trên nút nạp thẻ.</code>
                                <br>- . </div>								
								
								
								</div>
							
							
							<span data-toggle="collapse" data-target="#demo">
									Chú ý : Mục này dùng cho thành viên sử dụng link nạp trực tiếp không cần đăng nhập....xem thêm..</span>
									<div id="demo" class="collapse in"> 
							<code>	Chú ý : Mục này dùng cho thành viên sử dụng link nạp trực tiếp không cần đăng nhập....							
                                <br>- Chức năng cho phép thành viên thông báo thêm nội dung cho người nạp thẻ khi nạp thành công.
                                <br>- Mỗi thành viên có thể tạo nhiều nội dung thông báo, mỗi nội dung có một ID riêng.
                                <br>- Thông báo theo số tiền chỉ dành cho mã nhúng, không có tác dụng với link trực tiếp.
                                <br>- Khách hàng của bạn sẽ nhận được thông báo khi nạp thẻ bằng với số tiền khai báo, Để bằng 0 nếu bạn muốn thông báo khi nạp thẻ thành công với bất kỳ mệnh giá. Mặc định là bằng 0, khách của bạn sẽ nhận được thông báo khi nạp thẻ thành công. </code></div>								
								
								
								</div>
                        </div>
                    </div>
    </div>
@endsection