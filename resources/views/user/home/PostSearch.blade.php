<?php
?>
@extends('user.layout.app')
@section('content-1')
   <div class="col-xs-12 col-lg-8" style="margin-bottom: 1rem">
       <p class="search-keyword">Kết quả tìm kiếm cho từ khóa : <strong>"{{request('keyword')}}"</strong></p>
       <div class="row">
           <div class="col-12">
               <form action="{{url('search-posts')}}" method="get" class="">
                   <div class="form-search">
                       <input style="width: 90%" type="search" name="keyword" class="input form-search-input" value="{{request('keyword')}}" placeholder="Từ khóa...">
                       <button class="search-btn">Tìm Kiếm</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <div class="col-lg-8 col-12 content-left">
       @if(!empty($posts))
           @foreach($posts as $post)
               <div class="row" style="margin-bottom: 1rem">
                   <div class="col-4">
                       <a href="{{route('home.show',['home'=>$post->p_id])}}" class="post_link">
                           <img style="width: 100%;height: 200px" src="{{asset('img/'.$post->cover_img)}}" alt="{{$post->title}}">
                       </a>
                   </div>
                   <div class="col-8 post-by-parentCat">
                       <a href="{{route('home.show',['home'=>$post->p_id])}}" class="post_link">
                           <h4 class="text-wrap-title">{{$post->title}}</h4>
                       </a>
                       <p class="text-wrap-desc">{{$post->description}}</p>
                   </div>
               </div>
           @endforeach
       @else
           <p>Không tìm thấy kết quả nào</p>
       @endif
   </div>
@endsection
