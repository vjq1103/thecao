@extends('master')
@section('title')
   Thành viên đăng nhập
@endsection
@section('content')
<script src="{{ asset('css/app.css') }}" defer></script>



@if(session()->has('message'))
    <div class="alert alert-success" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('error'))

    <div class="alert alert-danger" data-animation-in="animated fadeIn" data-animation-out="animated fadeOut">
        {{ session()->get('error') }}
    </div>
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Đăng nhập') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">


                            <div class="col-md-12">
                                <input id="email" placeholder=" Vui lòng nhập email của bạn /Số điện thoại" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">


                            <div class="col-md-12">
                                <input placeholder="Vui lòng nhập mật khẩu" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



						<!--
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lưu tài khoản') }}
                                    </label>
                                </div>
                            </div>
                        </div>
						-->





                        <div class="form-group row">


                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center" >
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    {{ __('Đăng nhập') }}
                                </button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <center><button class="btn btn-sm waves-effect waves-light btn-success btn-outline-success text-center"><i class="icofont icofont-check-circled"></i><a href="{{ route('register') }}">Đăng Kí Ngay</a></button></center>

                        <br/>



                        <div class="form-group row">
                         <div class="col-md-12 text-right">

                            <label class="label label-info"><a class="label label-info text-white" href="{{ route('password.request') }}"> {{ __('Quên mật khẩu') }} </a></label>
                        </div>

                           </div>


                    </form>

            </div>
        </div>
    </div>
</div>
@endsection
