@extends('user.layout.user')
@section('title')
    <title>Đổi mật khẩu</title>
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
            <a href="{{route('categories.index')}}" class="post_link">Back to index</a>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{url('admin/update-pw-admin')}}" method="post" class="form-user">
        @csrf
        @method('POST')
        <h1 class="form-user-header">Đổi Mật Khẩu</h1>
        <input name='old_password' class="input" type="password" placeholder="Mật khẩu cũ">
        @error('old_password')
        <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='ad_password' class="input" type="password" placeholder="Mật khẩu mới">
        @error('ad_password')
        <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='ad_password_confirmation' class="input" type="password" placeholder="Xác nhận lại mật khẩu">
        @error('ad_password_confirmation')
        <strong class="error_validated">{{$message}}</strong>
        @enderror
        <input name='admin_id' class="input" type="hidden" value="{{auth('admin')->user()->admin_id}}">
        <button class="btn btn-warning btn-register">Đổi mật khẩu</button>
    </form>
@endsection
