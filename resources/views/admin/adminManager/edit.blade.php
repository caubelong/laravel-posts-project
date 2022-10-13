@extends('admin.layout.app')
@section('title')
    <title>Create Account Manager</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tin</h1>
            <span class="active">Tin / </span>
            <span >Sửa thông tin người quản lý</span>
        </div>
        <div class="main-create_posts">
            @if($errors->any())
                <div class="error-form">
                    <h3 class="text-danger">Sửa các lỗi sau :</h3>
                    <ul class="list-group list-group-numbered">
                        @foreach($errors->all() as $err)
                            <li class="list-group-item text-danger mt-3">{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('admin-manager.update',['admin_manager'=>$admins->admin_id])}}" method="post" id="form-post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="ad_password"
                           class="form-control" placeholder="Mật khẩu.."></input>
                </div>
                <div class="form-group">
                    <label for="">Quyền hạn</label>
                    <select class="form-control" name="role">
                        <option  class="optionGroup" selected disabled>Quyền hạn tài khoản</option>
                        <option  @if($admins->role == 'admin') selected @endif value="admin">Người quản trị ( admin )</option>
                        <option @if($admins->role == 'manager') selected @endif value="manager">Người quản lý ( manager ) </option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Sửa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
