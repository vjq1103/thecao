@extends('master')
 @section('title') Trang chủ @endsection
 @section('content')

@if(!Auth::guest())



<!--  nhận thẻ cào uy tín
<div class="jumbotron">
Xin chào: {{ Auth::user()->name }}
          <br/>
          Số dư:  {{ Auth::user()->money_1 }} đ. <br/>
          Tạm giữ:  {{ Auth::user()->tam_giu }} đ. <br/>

          Số điện thoại: {{ Auth::user()->phone_number }} <br/>
          Email: {{ Auth::user()->email }}
          <br/>Ngày gia nhập {{ Auth::user()->created_at }} <br/>

      <br/>

      </div>
      <iframe width="90%" height="345" src="https://www.youtube.com/embed/lm1KXCUIVPo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      --->
@else @endif


<?php
/**
      <br>
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
                      <h6>Nạp thẻ không đăng nhập</h6>
                      <p class="text-success">* Nếu bạn quên id frame, vui lòng đăng nhập và vào phần <strong>Tích hợp vào website</strong> để lấy id frame</p>
                      <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                  </div>
              <div class="table-responsive">
              <table class="table table-condensed table-hover table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>ID Frame</th>
                          <th>Loại Thẻ</th>
                          <th>Giá</th>
                          <th>Pin</th>
                          <th>Serial</th>
                          <th>Nạp</th>
                      </tr>
                  </thead>
                  <tbody>
                      <form action="{{ route('frame.createPayment') }}" method="POST" >
                        @csrf
                      <input type="hidden" name="nap_the" value="3">
                        <tr>
                            <td class="number" style="width: 20%;">
                               <input type="number" name="link_id" placeholder="Nhập vào frame id" class="form-control" required>
                            </td>
                            <td class="number" style="width: 20%;">
                                <select class="form-control" name="card_type" id="card_type" class="" required>
                                  @foreach ($card as $value)
                                    <option value="{{ $value->card_code }}">{{ $value->card_name }}</option>
                                  @endforeach
                                  </select>
                            </td>
                            <td class="number" style="width: 20%;">
                                <select required class="form-control" name="card_price">
                                    <option value="10000">10.000&nbsp;₫</option>
                                    <option value="20000">20.000&nbsp;₫</option>
                                    <option value="30000">30.000&nbsp;₫</option>
                                    <option value="50000">50.000&nbsp;₫</option>
                                    <option value="100000">100.000&nbsp;₫</option>
                                    <option value="200000">200.000&nbsp;₫</option>
                                    <option value="300000">300.000&nbsp;₫</option>
                                    <option value="500000">500.000&nbsp;₫</option>
                                    <option value="1000000">1.000.000&nbsp;₫</option>
                                 </select>
                            </td>
                            <td>
                              <input type="number" name="card_pin" placeholder="Nhập vào mã pin" class="form-control" required>
                            </td>
                            <td>
                              <input type="number" name="card_seria" placeholder="Nhập vào số serial" class="form-control" required>
                            </td>
                            <td class="number" style="width: 5%;">
                                <button class="btn btn-primary">Nạp</button>
                            </td>
                        </tr>
                    </form>
                  </tbody>
              </table>
       </div>
          </div>
        </div>
      </div>
      <br>
    **/ ?>

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


    <marquee width="100%" behavior="scroll" bgcolor="#27ae60" style="z-index:10001;margin:0;padding:0;position:fixed;bottom:0;left:0;right:0">
        <span style="color:#fff">Nạp thẻ Viettel, Mobi, và Vina - click đăng kí để tích hợp mã nhúng ngay!</span>
    </marquee>



    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-table">
                <h4>ĐỔI THẺ NHANH CK   @foreach ($result as $value)  @if($value->cat_id == 1)  {{ $value->ckcham }} %  @else
                                          @endif @endforeach </h4>
                <div class="panel-body">
                    <div class="table-responsive">

                        @if(Auth::guest())
                        <iframe src='/nap-the-cham/81' style='width:100% ; height:380px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
                        @else
                        <iframe src='/nap-the-cham/{{ Auth::user()->id}}' style='width:100% ; height:380px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="panel panel-default panel-table">
                <h4>BẢNG GIÁ NẠP THẺ</h4>
                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-bordered">
                             <thead>
                                              <tr>

                                                 <th>Loại thẻ</th>
                                                 <th class="number">Nạp nhanh</th>
                                                  <th class="number">Nạp chậm</th>
                                                 <th class="number">Trạng thái</th>
                                              </tr>

                            </thead>
                            <tbody class="no-border-x">
                                @foreach ($result as $value)
                                <tr>
                                    <!--<td>{{ $value->cat_id }}</td>-->
                                    <td style="text-align:center"><img src="/img/logo/{{ $value->card_name }}.png" alt="{{ $value->card_name }}" title="Đổi thẻ cào {{ $value->card_name }}" />
                                        <br/> <span class="label label-blue">{{ $value->card_name }}</span></td>
                                    <td class="number">{{ $value->card_discount }} %</td>
                                     <td class="number">{{ $value->ckcham }} %</td>
                                    <td class="number">
                                        @if($value->card_status == 1)
                                        <span class="label label-primary">HOẠT ĐỘNG</span> @else
                                        <span class="label label-kieu">TẠM NGƯNG</span> @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <?php

                /***
                <div class="panel panel-default panel-table">
                        <h4>ĐỔI THẺ CHẬM CK  @foreach ($result as $value)  @if($value->cat_id == 1)  {{ $value->ckcham }} %  @else
                                          @endif @endforeach </h4>
                         <div class="panel-body">
                            @if(Auth::guest())
                 <iframe src='http://8paydoithe.com/nap-the-cham/81' style='width:100% ; height:520px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
               @else
                <iframe src='http://8paydoithe.com/nap-the-cham/{{ Auth::user()->id}}' style='width:100% ; height:520px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
              @endif
                         </div>
                      </div>
        </div>

                ***/ ?>
    </div>

    <div class="jumbotron" style="background-color:#c5e2c5;color:#535054;/****/text-align:center;">

        <h5>8PAYDOITHE.COM - ĐỔI THẺ CÀO UY TÍN</h5> Hệ thống nhận thẻ cào qua mã nhúng và hệ thống api tự động 5 giây.

    </div>

    <hr>
    <div class="row">
        <div class="col-md-4">
            <h4>HƯỚNG DẪN SỬ DỤNG</h4> VIDEO HƯỚNG DẪN NẠP THẺ VÀ TÍCH HỢP <br/>
           <strong>Hệ thống đổi thẻ cào thành tiền mặt</strong><br/>
Hỗ trợ 3 nhà mạng Viettel, Mobifone, Vinaphone với tất cả các mệnh giá.<br/>
Chiết khấu chỉ từ 30 - 32%, tức là khi bạn đổi thẻ cào 100.000đ bạn sẽ nhận được số tiền tương ứng với chiết khấu<br/><br/><hr>
Tốc độ xử lý thẻ nhanh chóng. Trung bình từ 1 - 3 phút.<br/>
Hỗ trợ API trả kết quả tự động dành cho các webmaster.<br/>
        </div>
        <div class="col-md-4">

          <div class="panel panel-default panel-table">
                <h4>ĐỔI THẺ CHẬM   @foreach ($result as $value)  @if($value->cat_id == 1)  {{ $value->ckcham }} %  @else
                                          @endif @endforeach </h4>
                <div class="panel-body">
                    <div class="table-responsive">

                        @if(Auth::guest())
                        <iframe src='/nap-the-cham/81' style='width:100% ; height:380px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
                        @else
                        <iframe src='/nap-the-cham/{{ Auth::user()->id}}' style='width:100% ; height:380px' frameborder='0' marginwidth='0' marginheight='0' scrolling='yes'></iframe>
                        @endif
                    </div>
                </div>
            </div>
         </div>


       <div class="col-md-4">
        <h4>GIÁ NẠP CHẬM</h4>


            <div class="panel panel-default panel-table">
                <h4>BẢNG GIÁ NẠP THẺ</h4>
                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-bordered">
                             <thead>
                                             <!-- <tr>

                                                 <th>Loại thẻ</th>
                                                  <th class="number">Nạp chậm</th>
                                                 <th class="number">Trạng thái</th>
                                              </tr>
                                            -->

                            </thead>
                            <tbody class="no-border-x">
                                @foreach ($result as $value)
                                <tr>
                                    <!--<td>{{ $value->cat_id }}</td>-->
                                    <td style="text-align:center"><img src="/img/logo/{{ $value->card_name }}.png" alt="{{ $value->card_name }}" title="Đổi thẻ cào {{ $value->card_name }}" />
                                        <br/> <span class="label label-blue">{{ $value->card_name }}</span></td>
                                     <td class="number">{{ $value->ckcham }} %</td>
                                    <td class="number">
                                        @if($value->ckcham_status == 1)
                                        <span class="label label-warning">Hoạt động</span> @else
                                        <span class="label label-danger">Tạm dừng</span> @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>





        </div>

    </div>
    <br>



      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <h4>TIN TỨC</h4>
                <div class="panel-body">
                    <table class="table table-striped table-borderless">

                        <thead>
                            <!--<tr>
                                     <th class="number">Ảnh</th>
                                     <th>Tiêu đề</th>
                                     <th class="number">Mô tả</th>
                                  </tr> -->
                        </thead>
                        <tbody class="no-border-x">
                            @foreach($new as $tin)
                            <tr>
                                <!-- <td><a href="/new/{{ $tin->slug }}{{ $tin->id }}">{{ $tin->title }}</a></td> -->
                                <!-- <td>{{ $tin->id }}</td> -->
                                <!-- default-thumbnail/uploads/lamex/01/35484267_2086859751636924_1438769148866854912_n.jpg -->
                                <td>
                                    @if(empty($tin->image))
                                    <img class="img-thumbnail" src="/uploads/1368.jpg" alt="" /> @else
                                    <img class="img-thumbnail" src="{{ URL::to($tin->image) }}" alt="{{ $tin->title }}" title="Minh họa {{ $tin->title }}" /> @endif
                                </td>
                                <td><a href="/new/{{ $tin->slug }}/{{ $tin->id }}">{{ $tin->title }}</a></td>
                                <td>{!! str_limit($tin->content,150) !!}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
      </div>







    <script>
        function notice() {
            confirm("Vui lòng đăng nhập")
        }
    </script>

    @endsection
