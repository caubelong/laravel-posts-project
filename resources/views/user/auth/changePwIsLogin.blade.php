@extends('user.layout.user')
@section('title')
    <title>Đổi mật khẩu</title>
@endsection
@section('content')
    <form action="{{url('update-password')}}" method="post" class="form-user">
        @csrf
        @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
        <h1 class="form-user-header">Đổi Mật Khẩu</h1>
        <input name='old_password' class="input" type="password" placeholder="Mật khẩu cũ">
        @error('old_password')
                <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='user_password' class="input" type="password" placeholder="Mật khẩu mới">
        @error('user_password')
                <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='user_password_confirmation' class="input" type="password" placeholder="Xác nhận lại mật khẩu">
        @error('user_password_confirmation')
            <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='u_id' class="input" type="hidden" value="{{auth()->user()->u_id}}">

        <button class="btn btn-warning btn-register">Đổi mật khẩu</button>
        <p class="form-description"><a href="/home" class="forget-login">Quay lại trang trủ</a></p>
    </form>
@endsection
