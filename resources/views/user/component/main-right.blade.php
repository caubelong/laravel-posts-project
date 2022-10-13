<?php
use Illuminate\Support\Facades\DB;
$postsRandoom = DB::table('posts')
    ->where('option_show','=', 1)
    ->inRandomOrder()->limit(6)->get()->toArray();
$postsTopView= DB::table('posts')
   ->orderBy('view','desc')->limit(6)->get();
?>
<div class="col-lg-4 col-12 content-right">
    <img src="../picture/banner.jpg" class="img-banner" alt="">
    <div class="row">
        <div class="col-12">
            <div class="content-right-title">
                xem them
            </div>
            <ul class="content-right-list">
                @foreach($postsRandoom as $postrd)
                    <li class="content-right-item">
                        <div class="content-right-main">
                            <img class="content-right-main-img" src="{{asset('img/'.$postrd->cover_img)}}" style="">
                            <a href="{{route('home.show',['home'=>$postrd->p_id])}}" class="content-right-main-link" style="position: relative;top: -3px">
                                <h3 class="content-right-main-title text-wrap-title">
                                    {{$postrd->title}}
                                </h3>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <img src="../picture/banner2.jpg" class="img-banner" alt="">
            <div class="content-right-title">
                Được xem nhiều nhất
            </div>
            <ul class="content-right-list">
                @foreach($postsTopView as $postrd)
                    <li class="content-right-item">
                        <div class="content-right-main">
                            <img class="content-right-main-img" src="{{asset('img/'.$postrd->cover_img)}}" style="">
                            <a href="{{route('home.show',['home'=>$postrd->p_id])}}" class="content-right-main-link" style="position: relative;top: -3px">
                                <h3 class="content-right-main-title text-wrap-title">
                                    {{$postrd->title}}
                                </h3>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <img src="../picture/banner4.jpg" class="img-banner" alt="">
            <img src="../picture/banner3.jpg" class="img-banner" alt="">
        </div>
    </div>
</div>
