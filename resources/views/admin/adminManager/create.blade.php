@extends('admin.layout.app')
@section('title')
    <title>Create Account Manager</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tin</h1>
            <span class="active">Tin / </span>
            <span >Thêm mới người quản lý</span>
        </div>
        <div class="main-create_posts">
            @if($errors->any())
                <div class="error-form">
                    <h3 class="text-danger">Sửa các lỗi sau để thêm :</h3>
                    <ul class="list-group list-group-numbered">
                        @foreach($errors->all() as $err)
                            <li class="list-group-item text-danger mt-3">{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('admin-manager.store')}}" method="post" id="form-post">
                @csrf
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" name="ad_name"
                              class="form-control" placeholder="Tên.." value="@if(old('ad_name')){{old('ad_name')}}@endif"></input>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="ad_password"
                           class="form-control" placeholder="Mật khẩu.."></input>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="ad_email"
                           class="form-control" placeholder="Tên.." value="@if(old('ad_email')){{old('ad_email')}}@endif"></input>
                </div>
                <div class="form-group">
                    <label for="">Quyền hạn</label>
                    <select class="form-control" name="role">
                        <option class="optionGroup" selected disabled>Quyền hạn tài khoản</option>
                        <option value="admin">Người quản trị ( admin )</option>
                        <option value="manager">Người quản lý ( manager ) </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Thêm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
