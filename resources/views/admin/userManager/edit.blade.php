@extends('admin.layout.app')
@section('title')
    <title>Edit User</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tài khoản người dùng</h1>
            <span class="active">Nguời dùng/ </span>
            <span>Sửa Thông Tin Người Dùng</span>
        </div>
        <div class="main-create_posts" style="overflow-y:auto;height:550px ">
            @if($errors->any())
                <div class="error-form">
                    <h3 class="text-danger">Sửa các lỗi sau để tiếp tục :</h3>
                    <ul class="list-group list-group-numbered">
                        @foreach($errors->all() as $err)
                            <li class="list-group-item text-danger mt-3">{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('user-manager.update',['user_manager'=>$users->u_id])}}" method="post"id="form-post" 
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên người dùng</label>
                    <input type="text" cols="2" rows="3" name="usesr_name" class="form-control" 
                    placeholder="Tên ngươi dùng..." value="{{old('usesr_name')? old('usesr_name') : $users->usesr_name}}">
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <img src="{{asset('avatar/picture/'.$users->avatar)}}" style="width:100px;height: 100px" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="">Thay đổi ảnh đại diện</label>
                    <input type="file" name="avatar" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="user_email"class="form-control" 
                    value="{{old('user_email')? old('user_email') : $users->user_email}} "
                    placeholder="Email ...">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="number" name="phone" class="form-control" 
                    value="{{old('phone')? old('phone') : $users->phone}}"
                    placeholder="Số điện thoại ...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection