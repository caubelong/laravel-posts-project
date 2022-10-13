@php
use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use App\Models\CategoryChildren;
use App\Models\Category;
$categories = Category::all();
    if (isset($posts->p_id)){
        if ($posts->view ==0){
            $posts->view=1;
        }
        $viewsPosts = \Illuminate\Support\Facades\DB::table('posts')->where('p_id','=',$posts->p_id)
        ->update([
            'view'=>$posts->view +1
        ]);
    }
@endphp
@extends('user.layout.app')
@section('content-1')
            <div class="col-12 col-lg-8">
                <div id="detail-main">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            @php $getcategory= CategoryChildren::find($posts->category_id);
                                $categoryBig=$getcategory->categories->category_name
                            @endphp
                            <div class="category-detail-post">
                                <h3 class="post-detail-category category">{{$categoryBig}}</h3>
                                <i class="fa fa-angle-right"></i>
                                <h3 class="post-detail-category category-children" style="">{{$posts->category->name}}</h3>
                            </div>
                            <h2 class="post-detail-title">{{$posts->title}}</h2>
                            <div class="created-ad-post-detail">
                                <span style="color:#fda444;margin-right: 10px;font-weight: 700;font-size: 14px">KENH14</span>
                                <i class="fa-regular fa-clock"></i>
                                <span class="created_at">{{$posts->created_at->format('Y.m.d H/i/s')}}</span>
                                <span style="color:#757575;font-size: 15px;"><i class="post-view fa-solid fa-eye"></i>{{$posts->view}}</span>
                            </div>
                            <p class="post-detail-desc">{{$posts->description}}</p>
                            <div class="post-detail-body" style="border-bottom: 1px solid #ccc" >
                                <div>{!! $posts->body !!}</div>
                            </div>
                            <span class="backtotop"><i class="backtotop-icon fa-solid fa-arrow-up-long"></i></span>
                        </div>
                        <section class="comment-first">
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
                                        @if(auth()->user() && $comment->users->u_id ==auth()->user()->u_id)
                                        <div class="comment-header-right">
                                            <form action="{{url('destroy-comment',['id'=>$comment->cmt_id])}}" style="margin-left:0.5rem" method="post">
                                                @csrf @method('delete')
                                                <button class="action-categories" style="border: none;background-color: transparent" onclick="return confirm('bạn có muốn xóa bình luận này không ?')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="comment-main">
                                        <p class="comment-content">
                                            {{$comment->content_cmt}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h6>Chưa có bình luận nào ! </h6>
                        @endforelse
                        @if(auth()->check())
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div id="form-create-comment">
                                        <img class="comment-avatar-user" src="{{asset('avatar/picture/'.auth()->user()->avatar)}}" alt="">
                                        <form action="/push-comment" method="POST" class="form-comment">
                                            @csrf
                                            <input type="hidden" name='u_id' value="{{auth()->user()->u_id}}">
                                            <input type="hidden" name='post_id' value="{{$posts->p_id}}">
                                            <textarea style="width: 100%" name="content_cmt" class="content_cmt" cols="145" rows="3" placeholder="Ý kiến của bạn"></textarea>
                                            @error('content_cmt')
                                            <strong class="error_validated">{{$message}}</strong>
                                            @enderror
                                            <button class="btn btn-primary add-cmt-submit" type="submit">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                @else
                                    <a href="{{url('user-login')}}" class="post_link">Đăng nhập để bình luận</a>
                                @endif
                            </div>
                    </div>
                    @if(!empty($categories))
                        @foreach($categories as $category)
                            <?php
                                $getPostSameCate = $category->listPostsIsCategory->take(8)->sortDesc();
                            ?>
                            @foreach($getPostSameCate as $getPostSame)
                                <?php
                                    $categoryChilName=CategoryChildren::find($getPostSame->category_id)->name;
                                ?>
                            <div class="row post-same-category" style="margin-top: 2rem">
                                <div class="col-12 col-lg-8">
                                    <a href="{{route('home.show',['home'=>$getPostSame->p_id])}}" class="post_link">
                                        <h4 class="post-same-title">
                                            {{$getPostSame->title}}
                                        </h4>
                                    </a>
                                    <p class="post-same-desc">
                                      {{$getPostSame->description}}
                                    </p>
                                    <span class="same-category-category-name" style="">{{$categoryChilName}}</span>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <a href="{{route('home.show',['home'=>$getPostSame->p_id])}}" class="post_link">
                                        <img style="width: 100%;height: 150px" src="{{asset('img/'.$getPostSame->cover_img)}}" alt="{{$getPostSame->title}}">
                                    </a>
                                </div>
                            </div>
                                @endforeach
                        @endforeach
                    @endif
                </div>
        @endsection
        @section('script')
        <script>
            const mainContentImgEl = document.querySelectorAll('#detail-main .post-detail-body img')
            const descImgWrapperEl = document.querySelectorAll('#detail-main .post-detail-body figcaption')
            const imgEl = document.querySelectorAll('#detail-main .post-detail-body .image img')
            const btnBackToTopEl = document.querySelector('.backtotop')
            const formInputContentEl = document.querySelector('.content_cmt')
            const btnAddCmt = document.querySelector('.add-cmt-submit')
            if(btnAddCmt){
                btnAddCmt.disabled=true;
            }
            if(formInputContentEl){
                formInputContentEl.addEventListener('keyup',()=>{
                    if(formInputContentEl.value) {
                        btnAddCmt.disabled=false
                    }else{
                        btnAddCmt.disabled=true
                    }
                })
            }
            // khi bấm vào nút sẽ quay lại đầu trang
            btnBackToTopEl.style.cursor='pointer'
            btnBackToTopEl.addEventListener('click',()=>{
                console.log('aaa')
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
    </div>
</div>
@endsection
