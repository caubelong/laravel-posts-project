@extends('user.layout.user')
@section('title')
    <title>Đổi mật khẩu</title>
@endsection
@section('content')
    <form action="{{url('reset-password')}}" method="post" class="form-user">
        @csrf
        <h1 class="form-user-header">Đổi Mật Khẩu</h1>
        <input name='user_password' class="input" type="password" placeholder="Mật khẩu mới">
        <input name='u_id' class="input" type="hidden" value="{{$users->u_id}}">
        @error('user_password')
                <strong class="error_validated">{{$message}}</strong>
            @enderror
        <button class="btn btn-warning btn-register">Đổi mật khẩu</button>
    </form>
@endsection
