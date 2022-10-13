@extends('user.layout.user')
@section('title')
    <title>Quên Mật Khẩu</title>
@endsection
@section('content')
    @if(Session::has('notify'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
    @endif
    <form action="/change-pw" method="POST" class="form-user">
        @csrf
        <h1 class="form-user-header">Quên Mật Khẩu</h1>
        <input name='user_email' class="input" type="email" placeholder="Email">
        @error('user_email')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
        <input name='phone' class="input" type="number" placeholder="Số điện thoại">
        @error('phone')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
        <button class="btn btn-warning btn-register">Đặt lại mật khẩu</button>
        <p class="form-description">Bạn đã có tài khoản ? <a href="/user-login" class="forget-login">Đăng nhập</a></p>
    </form>
@endsection
