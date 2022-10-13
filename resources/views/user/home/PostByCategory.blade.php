<?php
use App\Models\Category;
use App\Models\CategoryChildren;
?>
@extends('user.layout.app')
@section('content-1')
        <div class="col-12">
            <div class="category-detail-post">
                <h3 class="post-detail-category category category-children">{{$categoryList->category_name}}</h3>
            </div>
        </div>
        <div class="col-lg-8 col-12 content-left">
            @if(!empty($categoryList))
                @foreach($categoryList->listPostsIsCategory as $posts)
            <div class="row" style="margin-bottom: 1rem">
                <div class="col-4">
                    <a href="{{route('home.show',['home'=>$posts->p_id])}}" class="post_link">
                        <img class="post-by-category-img" src="{{asset('img/'.$posts->cover_img)}}" alt="{{$posts->title}}">
                    </a>
                </div>
                <div class="col-8 post-by-parentCat">
                    <a href="{{route('home.show',['home'=>$posts->p_id])}}" class="post_link">
                        <h4 class="text-wrap-title">{{$posts->title}}</h4>
                    </a>
                    <p class="text-wrap-desc">{{$posts->description}}</p>
                </div>
            </div>
                @endforeach
            @endif
        </div>
@endsection
