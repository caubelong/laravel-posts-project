@extends('user.layout.user')
@section('title')
    <title>Đăng nhập</title>
@endsection
@section('content')
    @if(Session::has('notify'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
    @endif
   <div class="container">
       <div class="row">
           <div class="col-xs-12">
               <form action="user-login" method="POST" class="form-user">
                   @csrf
                   <h1 class="form-user-header">Đăng nhập</h1>
                   <input name='user_email' class="input" type="email" placeholder="Email">
                   @error('user_email')
                   <strong class="error_validated">{{$message}}</strong>
                   @enderror
                   <input name='user_password' class="input" type="password" placeholder="Mật khẩu">
                   @error('user_password')
                   <strong class="error_validated">{{$message}}</strong>
                   @enderror
                   <button class="btn btn-warning btn-register">Đăng nhập</button>
                   <div class="forget-password-link"><a href="/forgot-password" class="forget-password-link">Quên mật khẩu ?</a></div>
                   <p class="form-description">Bạn chưa có tài khoản ? <a href="/user-register" class="forget-login">Đăng ký</a></p>
               </form>
           </div>
       </div>
   </div>
@endsection
