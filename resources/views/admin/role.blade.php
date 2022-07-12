@extends('master')
@section('title')
    Quản lý User
@endsection
@section('content')

<style type="text/css">body {max-width:99%!important;}</style>
@if(Auth::user()->is_Admin == 10 || Auth::user()->is_Admin == 9)
  
    <h6>Danh sách thành viên</h6>
    <div class="row">
        <div class="col-md-12">
             @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Sdt</th>
                        <th>Email</th>
                        <th>Money</th>
                        <th>Tạm giữ</th>						
                        <th>Ngày</th>
                        <th>Role</th>
                        <th>AdminLV</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
               
                    @foreach($user as $value)
                    <form action="{{route('user.updateUser')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $value->id }}">
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td><input name="phone" type="text" value="{{ $value->phone_number }}"></td>
                            <td><input name="email" type="text" value="{{ $value->email }}"></td>
                            <td><input name="money_1" type="text" value="{{ $value->money_1 }}"></td>
                            <td><input name="tam_giu" type="text" value="{{ $value->tam_giu }}"></td>
                            <td>{{ $value->created_at }}</td>
                            <td>
                                @if($value->is_Admin === 1)
                                    <span>Admin</span>
                                @else 
                                    <span>Thành viên</span>
                                @endif    
                            </td>
                            <td><input name="is_Admin" type="text" value="{{ $value->is_Admin }}"></td>
                            <td><button>Sửa</button></td>
                        </tr>
                        </form> 
                    @endforeach 
                 
                </tbody>
            </table>
        </div>
    </div>
	<div style="float: right;margin-top:5%"class="text-center">{{ $user->links() }}</div>
@endif
 
@endsection