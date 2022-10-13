@extends('admin.layout.auth')
@section('title')
    <title>Đăng nhập trang quản trị</title>
@endsection
@section('content')
    @if(Session::has('notify'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
    @endif
    <form action="{{url('login-admin')}}" method="POST" id="form-user">
        @csrf
        <h1 class="form-user-header">Đăng nhập trang quản trị</h1>
        <input name='ad_name' class="input" type="text" placeholder="Tài khoản">
        @error('ad_name')
        <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='ad_password' class="input" type="password" placeholder="Mật khẩu">
        @error('ad_password')
        <strong class="error_validated">{{$message}}</strong>
        @enderror
        <button class="btn btn-warning btn-register">Đăng nhập</button>
    </form>
@endsection
