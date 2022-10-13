@extends('admin.layout.layout_detail')
@section('title')
    <title>Detail Post</title>
@endsection
@section('content')
    <div id="detail-main">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="main-header">
                    <h1>Posts</h1>
                    <span class="active">Posts / </span>
                    <span >Detail Posts</span>
                </div>
                <a style="margin-top: 10px" class="backtohome" href="{{route('posts.index')}}"><i class="backtohome-icon fa-solid fa-arrow-left"></i>Quay lại trang trủ</a>
                <h3 class="post-detail-category">{{$posts->category->name}}</h3>
                <h1 class="post-detail-title">{{$posts->title}}</h1>
                <p class="post-detail-desc">{{$posts->description}}</p>
                <div class="post-detail-createdTime">
                    <span class="post-detail-time">{{substr($posts->created_at,0,10)}}</span>
                    <svg width="5" height="6" viewBox="0 0 5 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2.5" cy="3" r="2.5" fill="#747683" fill-opacity="0.32"></circle>
                    </svg>
                    <span class="post-detail-time">{{substr($posts->created_at,10,6)}}</span>
                </div>
                <div class="post-img" style="display: flex">
                    <img width="50%" src="{{asset('img/'.$posts->cover_img)}}" alt="{{$posts->title}}" style="margin: 10px auto 20px auto">
                </div>
                <div class="post-detail-body" style="border-bottom: 1px solid #ccc" >
                    <div>{!! $posts->body !!}</div>
                </div>
                <a style="margin-top: 10px" class="backtohome" href="{{route('posts.index')}}"><i class="backtohome-icon fa-solid fa-arrow-left"></i>Quay lại trang trủ</a>
            </div>
            <section class="comment-first" style="width:100%;padding-left: 10px">
                <h2>Các bình luật của bài viết</h2>
            </section>
            @forelse ($posts->comments as $comment)
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div id="comment-component">
                    <div class="comment-header">
                        <div class="comment-header-left">
                            <img class="comment-avatar-user" src="{{asset('avatar/picture/'.$comment->users->avatar)}}" alt="">
                            <div class="comment-detail">
                                @if($comment->users)
                                <p class="coment-header-name">{{$comment->users->usesr_name}}</p>
                                @endif
                                <span class="comment-header-time">{{$comment->created_at}}</span>
                            </div>
                        </div>
                        <div class="comment-header-right">
                            <form action="{{url('destroy-comment',['id'=>$comment->cmt_id])}}" style="margin-left:0.5rem" method="post">
                                @csrf @method('delete')
                                <button class="action-categories" onclick="return confirm('bạn có muốn xóa bình luận này không ?')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="comment-main">
                        <p class="comment-content">
                            {{$comment->content_cmt}}
                        </p>
                    </div>
                </div>
            </div>
            @empty
                <h6 style="padding-left: 15px">Chưa có bình luận nào ! </h6>
            @endforelse
        </div>
    </div>
@endsection
@section('script')
    <script>
        const mainContentImgEl = document.querySelectorAll('#detail-main .post-detail-body img')
        const descImgWrapperEl = document.querySelectorAll('#detail-main .post-detail-body figcaption')
        const imgEl = document.querySelectorAll('#detail-main .post-detail-body .image img')
        const btnBackToTopEl = document.querySelector('.backtotop')
        // khi bấm vào nút sẽ quay lại đầu trang
        btnBackToTopEl.style.cursor='pointer'
        btnBackToTopEl.addEventListener('click',()=>{
            window.scrollTo({
                top:10,
                behavior: 'smooth',
            })
        })
        //thêm thuộc tính để phụ để ảnh có độ rộng bằng vs ảnh
        mainContentImgEl.forEach(e=>{
            if( window.innerWidth <'1000'){
                e.style.maxWidth=325+'px'
                e.style.height='auto'
                changeDescImg
            }
            if( window.innerWidth >='1536'){
                e.style.maxWidth=100+'%'
                e.style.height='auto'
                changeDescImg()
            }
        })
        function changeDescImg(){
            descImgWrapperEl.forEach(desc=>{
                imgEl.forEach(img=>{
                    desc.style.width=img.clientWidth+'px'
                })
            })
        }
    </script>
@endsection
