@extends('user.layout.app')
@section('content-1')
            <div class="col-lg-8 col-12 content-left">
                @php
                    $remaining8item= $postsNews->splice(2);
                @endphp
                <div class="content-1 row">
                    <div class="col-12 col-lg-8">
                       <div class="content-box">
                           <a href="{{route('home.show',['home'=>$postsNews[0]->p_id])}}" class="post_link">
                               <img class="item-img-content" src="{{asset('img/'.$postsNews[0]->cover_img)}}"
                                    alt="{{$postsNews[0]->title}}">
                               <h4 class="item-title">
                                   <p>{{$postsNews[0]->title}}</p>
                               </h4>
                           </a>
                           <p class="item-description">
                               {{$postsNews[0]->description}}
                           </p>
                       </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="content-box">
                            <a href="{{route('home.show',['home'=>$postsNews[0]->p_id])}}" class="post_link">
                                <img class="item-img-content" src="{{asset('img/'.$postsNews[1]->cover_img)}}"
                                     alt="{{$postsNews[1]->title}}">
                                <h4 class="item-title">
                                    <p>{{$postsNews[1]->title}}</p>
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-2 row" style="margin-top: 2rem">
                    @php
                        $remaining5item = $remaining8item->splice(3);
                    @endphp
                    @if(!empty($remaining8item))
                        @foreach($remaining8item as $content_2)
                    <div class="col-12 col-lg-4">
                       <div class="content-box">
                           <a href="{{route('home.show',['home'=>$content_2->p_id])}}" class="post_link">
                               <img src="{{asset('img/'.$content_2->cover_img)}}" class="item-img-content-2" alt="{{$content_2->title}}">
                               <h4 class="item-title">
                                   <p>{{$content_2->title}}</p>
                               </h4>
                           </a>
                       </div>
                    </div>
                        @endforeach
                    @endif
                </div>
                <div class="content-3 row" style="margin-top: 2rem">
                    @if(!empty($remaining5item))
                        @foreach($remaining5item as $content_3)
                            <div class="col-12">
                                <div class="row">
                                        <div class="col-6 col-lg-4" style="margin-bottom: 2rem">
                                            <a href="{{route('home.show',['home'=>$content_3->p_id])}}" class="post_link">
                                                <img src="{{asset('img/'.$content_3->cover_img)}}" class="item-img-content-3"
                                                     alt="{{$content_3->title}}">
                                            </a>
                                        </div>
                                        <div class="col-6 col-lg-8">
                                            <a class="post_link" href="{{route('home.show',['home'=>$content_3->p_id])}}">
                                                <p class="item-title">{{$content_3->title}}</p>
                                            </a>
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @foreach ($categoryNavBar as $key=> $categoryName_slider)
{{--                   @php dump($categoryName_slider::find(5)->listPostsIsCategory[0]->category_id);--}}
{{--                        dump($categoryName_slider::find(5)->listPostsIsCategory);--}}
{{--                        dump($categoryName_slider::find(5));--}}
{{--                        dump(\App\Models\CategoryChildren::find($categoryName_slider::find(5)->listPostsIsCategory[0]->category_id)->name)--}}
{{--                   @endphp--}}
                <div class="slider-content row">
                   <div class="category-slider-header col-12">
                       <h3>{{$categoryName_slider->category_name}}</h3>
                   </div>
                    <div class="col-12">
                        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel" data-interval="1000" style="padding: 0">
                            <div class="MultiCarousel-inner">
                                @php
                                    //dd($categoryParent_slider::find(5)->listPostsIsCategory);
                                        $postSliders=$categoryName_slider->listPostsIsCategory->take(6);
                                @endphp
                                @foreach ($postSliders as $postSlider)
                                    <div class="item slider-content-box">
                                        <div class="pad15">
                                            <div class="slider-item">
                                                <a href="{{route('home.show',['home'=>$postSlider->p_id])}}" class="post_link">
                                                    <img class="slider-pc-content__img" src="{{asset('img/'.$postSlider->cover_img)}}" alt="">
                                                    <h4 class="lead slider-item-title text-wrap-title" style="height: 65px">{{$postSlider->title}}</h4>
                                                </a>
                                                <p class="slider-item-desc text-wrap-desc">
                                                    {{$postSlider->description}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary leftLst"><</button>
                            <button class="btn btn-primary rightLst">></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
@endsection
