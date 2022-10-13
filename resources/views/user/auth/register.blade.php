@extends('user.layout.user')
@section('title')
    <title>Đăng ký</title>
@endsection
@section('style')
@endsection
@section('content')
        <form action="/user_register" class="form-user" method="POST">
            @csrf
            <h1 class="form-user-header">Đăng ký tài khoản</h1>
            <input name='user_name' value="{{old('user_name')}}" class="input" type="text" placeholder="Tên đăng ký">
            @error('user_name')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
            <input name='user_email' value="{{old('user_email')}}" class="input" type="email" placeholder="Email">
            @error('user_email')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
            <input name='phone'value="{{old('phone')}}" class="input" type="number"placeholder="Số điện thoại">
            @error('phone')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
            <input name='user_password'  value=""  class="input" type="password" placeholder="Mật khẩu">
            @error('user_password')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
            <input name='user_password_confirmation' value="" class="input" type="password" placeholder="Nhập lại mật khẩu">
            @error('user_password_confirmation')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
            <button class="btn btn-primary btn-register">Đăng ký</button>
            <p class="form-description">Bạn đã có tài khoản ? <a href="/user-login" class="forget-login">Đăng nhập</a></p>
        </form>
@endsection
