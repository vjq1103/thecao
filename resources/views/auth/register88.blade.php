@extends('master')
@section('title')
   Gia nhập thành viên
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gia nhập thành viên hệ thống đổi thẻ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
							<em>Username có thể viết hoa cách có dấu hoặc viết liền</em>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-left">Số Phone</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tinh" class="col-md-4 col-form-label text-md-left">Nơi ở</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="tinh" id="tinh">
                                    
                                </select>
                            </div>
                        </div> <!--  -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email của bạn') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
							
							<em>Mật khẩu 6 ký tự trở lên bao gồm chữ in hoa, chữ thường và số</em>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">Nhập lại mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password2" class="col-md-4 col-form-label text-md-left">Pass giao dịch</label>

                            <div class="col-md-6">
                                <input id="password2" type="password" class="form-control" name="password2" required>
                            </div>
							<i>Dùng cho các giao dịch quan trọng như rút tiền chuyển tiền. Mật khẩu phải bao gồm chữ cái viết hoa, chữ thường và số</i>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Gia nhập đổi thẻ') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
</script>
@endsection
