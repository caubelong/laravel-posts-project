@extends('admin.layout.app')
@section('title')
    <title>Hoạt động bình của người dùng</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tài khoản người dùng</h1>
            <span class="active">Nguời dùng/ </span>
            <span>Hoạt động bình luận</span>
        </div>
        <div class="main-create_posts" style="overflow-y:auto;height:550px ">
            <h3>Hoạt động bình luận</h3>
            @foreach($getCmtUser as $getcmt)
            <div class="get-comment-user">
                <img class="get-comment-detail get-comment-user__avatar"  style="width:50px;height: 50px;border-radius: 50px" src="{{asset('avatar/picture/'.$getcmt->avatar)}}">
                <p class="get-comment-user__name">{{$getcmt->usesr_name}}</p>
            </div>
            <div class="content-comment">
                <p class="content">{{$getcmt->content_cmt}}</p>
                <p class="get-comment-user__created_at">{{$getcmt->created_at}}</p>
            </div>
            <div class="get-title-post">
                <h3 class="title-post"><a class="title-link" href="{{route('posts.show',['post'=>$getcmt->p_id])}}">{{$getcmt->title}}</a></h3>
            </div>
            @endforeach
        </div>
    </div>
@endsection