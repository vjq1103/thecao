@extends('master')
@section('title')
   Đăng kí thành viên
@endsection

@section('content')

<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('ĐĂNG KÍ NẠP THẺ') }}</div>

                <div class="card-body">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Email</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Điện Thoại</a>
                            <div class="slide"></div>
                        </li>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="home3" role="tabpanel">
                            <!--- Nội dung Form 1 --->

                            <form method="POST" action="{{ route('register') }}">
                                @csrf




                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input placeholder="{{ __('Họ và tên bạn') }} " id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }} - Username có thể viết hoa cách có dấu theo tên bạn hoặc viết liền</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>






{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <select  class="form-control" name="tinh" id="tinh">--}}

{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input placeholder="{{ __('Email của bạn') }}" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input placeholder="Nhập Mã OTP" id="maotp" type="text" class="form-control" name="maotp" required autofocus>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="otp-email">
                                        <buttons  class="btn btn-sm btn-danger"> Lấy Mã OTP</buttons>
                                    </div>
                                    </div>

                                </div>



                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="ref"  placeholder="Nhập mã giới thiệu" type="text" class="form-control{{ $errors->has('ref') ? ' is-invalid' : '' }}" name="ref" value="{{ old('ref') }}" required autofocus>
                                        @if ($errors->has('ref'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ref') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input placeholder="Nhập mật khẩu của bạn" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }} - Mật khẩu 6 ký tự trở lên bao gồm chữ in hoa, chữ thường và số</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input  placeholder="Nhập lại mật khẩu" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input placeholder="MK Giao Dịch" id="password2" type="password" class="form-control" name="password2" required>
                                        @if ($errors->has('password2'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password2') }} - Mật khẩu cấp 2 dùng cho các giao dịch quan trọng như rút tiền chuyển tiền. Mật khẩu phải bao gồm chữ cái viết hoa, chữ thường và số</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <br/>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            {{ __('ĐĂNG KÝ') }}
                                        </button>
                                    </div>

                                </div>
                            </form>


                            <div class="form-group row">
                                <div class="col-12 text-right">
                              <a class="label label-info text-white" href="{{ route('login') }}"> Quay lại đăng nhập </a>
                                </div>

                            </div>








                            <!--- /Nội dung 1 --->

                            <p class="m-0"> <!--- Nội dung 2 ---> </p>
                        </div>
                        <div class="tab-pane" id="profile3" role="tabpanel">



                            <p class="m-0"><!--- Nội dung 2 ---> </p>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf




                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input placeholder="{{ __('Họ và tên bạn') }} " id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }} - Username có thể viết hoa cách có dấu theo tên bạn hoặc viết liền</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">


                                    <div class="col-md-12">
                                        <input placeholder="Số Điện Thoại" id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }} - Vui lòng nhập đúng số của bạn</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>





                                {{--                                <div class="form-group row">--}}
                                {{--                                    <div class="col-md-12">--}}
                                {{--                                        <select  class="form-control" name="tinh" id="tinh">--}}

                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}



                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input placeholder="Nhập Mã OTP" id="maotp" type="text" class="form-control" name="maotp" required autofocus>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="otp-phone">
                                            <buttons  class="btn btn-sm btn-danger"> Lấy Mã OTP</buttons>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="ref"  placeholder="Nhập mã giới thiệu" type="text" class="form-control{{ $errors->has('ref') ? ' is-invalid' : '' }}" name="ref" value="{{ old('ref') }}" required autofocus>
                                        @if ($errors->has('ref'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ref') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input placeholder="Nhập mật khẩu của bạn" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }} - Mật khẩu 6 ký tự trở lên bao gồm chữ in hoa, chữ thường và số</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input  placeholder="Nhập lại mật khẩu" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input placeholder="MK Giao Dịch" id="password2" type="password" class="form-control" name="password2" required>
                                        @if ($errors->has('password2'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password2') }} - Mật khẩu cấp 2 dùng cho các giao dịch quan trọng như rút tiền chuyển tiền. Mật khẩu phải bao gồm chữ cái viết hoa, chữ thường và số</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <br/>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            {{ __('ĐĂNG KÝ') }}
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <div class="form-group row">
                                <div class="col-12 text-right">
                                    <a class="label label-info text-white" href="{{ route('login') }}"> Quay lại đăng nhập </a>
                                </div>
                            </div>




                            <!--- Nội dung 2 Form --->




                            <!--- /Nội dung 2 --->
                        </div>

                    </div>
                </div>






                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var arr = [];
    $.ajax({
        url: "{{ route('api.tinh') }}",
        type: "get",
        dateType: "text",
        success: function(result) {
            var htmlResult = "";
            Object.keys(result).forEach(function(key) {
                var name = result[key].name;
                var matp = result[key].matp;
                htmlResult += "<option value='"+matp+"'>" + name +"</option>"
            })
            $("#tinh").append(htmlResult);
        }
    });

    $(document).ready(function(){
        $('.otp-email').click(function(){
            const email = $('#email').val();
            if(!email){
                alert('Bạn phải nhập Email');
                return false;
            }
            const  route = '{{route('send.otp')}}';
            const _token = $('input[name=_token]').val();
            $.ajax({
                url: route,
                type: "POST",
                data: {
                    'email': email,'_token': _token
                },
                success:function (response){
                    $('.otp-email').hide();
                    alert(response);
                }
            })
        })

        $('.otp-phone').click(function(){
            const phone = $('#phone_number').val();
            if(!phone){
                alert('Bạn phải nhập số điện thoại');
                return false;
            }
            const  route = '{{route('send.otp')}}';
            const _token = $('input[name=_token]').val();
            $.ajax({
                url: route,
                type: "POST",
                data: {
                    'phone': phone,'_token': _token
                },
                success:function (response){
                    $('.otp-email').hide();
                    alert(response);
                }
            })
        })
    })
    // export default {
    //     components: {Buttons}
    // }
</script>
@endsection
