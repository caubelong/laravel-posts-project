@extends('admin.layout.app')
@section('title')
    <title>Detail User</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tài khoản người dùng</h1>
            <span class="active">Nguời dùng/ </span>
            <span>Thông Tin Người Dùng</span>
        </div>
        <div class="main-create_posts" style="overflow-y:auto;height:550px ">
            <div class="info_user">
                <span class="info_user-title">Ảnh đại diện:</span>
                <img class="info_detail"  style="width:100px;height: 100px;border-radius: 50px" src="{{asset('avatar/picture/'.$users->avatar)}}">
            </div>
            <div class="info_user">
                <span class="info_user-title">Tên:</span>
                <p class="info_detail">{{$users->usesr_name}}</p>
            </div>
            <div class="info_user">
                <span class="info_user-title">Email:</span>
                <p class="info_detail">{{$users->user_email}}</p>
            </div>
            <div class="info_user">
                <span class="info_user-title">Số điện thoại:</span>
                <p class="info_detail">{{$users->phone}}</p>
            </div>
            <div class="info_user">
                <span class="info_user-title">Hoạt động bình luận:</span>
                <a class="info_detail" href="{{url('admin/get-comment-user',['id'=>$users->u_id])}}">Xem tại đây</a>
            </div>
        </div>
    </div>
@endsection