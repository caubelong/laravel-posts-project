@extends('user.layout.app')
@section('content-1')
    <div class="col-lg-8 col-12 content-left">
        <div class="main-create_posts" style="overflow-y:auto;height:550px;border: 1px solid #E5E5E5;padding: 20px;margin:10px 0">
            <h5>Hoạt động bình luận</h5>
            @if($getCmtUser->count()==0)
                <p>Chưa có bình luận nào</p>
            @else
                @foreach($getCmtUser as $getcmt)
                    <div class="get-comment-user" style="display: flex">
                        <img class="get-comment-detail get-comment-user__avatar"  style="width:50px;height: 50px;border-radius: 50px" src="{{asset('avatar/picture/'.$getcmt->avatar)}}">
                        <p class="get-comment-user__name" style="font-weight: 700;margin-left: 10px;margin-top: 10px">{{$getcmt->usesr_name}}</p>
                    </div>
                    <div class="content-comment">
                        <p class="content">{{$getcmt->content_cmt}}</p>
                        <p class="get-comment-user__created_at">{{$getcmt->created_at}}</p>
                    </div>
                    <div class="get-title-post" style="border-bottom: 1px solid #e1e1e1;margin-bottom: 2rem">
                        <h3 class="title-post"><a class="title-link post_link text-wrap-title" href="{{route('home.show',['home'=>$getcmt->p_id])}}">{{$getcmt->title}}</a></h3>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
