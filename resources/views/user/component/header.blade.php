<?php
    use App\Models\Category;
    use App\Models\CategoryChildren;
    $categoryNavBar=Category::all();
    $categoryShowMenu = CategoryChildren::all();
?>
<div class="header" style="position: relative;">
    <div class="header-brand">
        <a href="{{route('home.index')}}" class="header-brand-name post_link">Kenh14.vn</a>
        <div class="header-tag-news">
            <ul class="tag-news-list">
                @foreach( $categoryShowMenu->random(4) as $category)
                <li class="tag-news-item">
                    <a class="tag-news-link" href="{{asset(url('posts-by-category-chil',['parent_id'=>$category->chil_cate_id]))}}">#{{$category->name}}</a>
                </li>
                    @endforeach
            </ul>
        </div>
        <span class="menu-show-mobile"><i class="menu-mobile-icon  fa-solid fa-bars"></i></span>
    </div>
{{--    menu mobile--}}
    <nav class="menu-mobile-wrap animate__animated animate__fadeInLeft">
        <div class="nav-mobile-content">
            <span class="btn-close-nav-mb"><i class="close-nav-mb-icon fa-sharp fa-solid fa-xmark"></i></span>
            <ul class="menu-list-mobile">
                <li class="list-mobile-item">
                    <a href="/home" class="post_link">
                        <i style="color: #FFFFFF;font-size: 16px" class="fa-solid fa-house"></i>
                    </a>
                </li>
                <li class="list-mobile-item">
                        @auth
                    <li class="list-mobile-item">
                        <p class="user_name-mobile">{{auth()->user()->usesr_name}}</p>
                    </li>
                        @endauth
                        @guest
                            <i class="fa-solid fa-user"></i>
                            <a href="/user-login" class="user-login-link">Đăng nhập</a>
                        @endguest
                </li>
                    @foreach($categoryNavBar as $catParentMb)
                        <li class="list-mobile-item">
                            <a href="{{asset(url('posts-by-category',['id'=>$catParentMb->cate_id]))}}" style="position:relative ;color: #FFFFFF;text-transform: uppercase;font-family: 'Roboto" class="post_link">{{$catParentMb->category_name}}</a>
                            <i class="icon-dropdown-menu-mb fa fa-angle-down" aria-hidden="true"></i>
                            <ul class="sub-menu-mobile animate__animated animate__fadeInDown">
                               @foreach($catParentMb->children_category as $submenu)
                                   <li class="sub-menu-item">
                                       <a href="{{asset(url('posts-by-category-chil',['parent_id'=>$submenu->chil_cate_id]))}}" style="color: #FFFFFF;text-transform: uppercase" class="post_link">{{$submenu->name}}</a>
                                   </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
            </ul>
        </div>
    </nav>
</div>
<!-- Menu mobile -->
{{--<div class="menu-content container" id="menu-bar">--}}
{{--    <header class="menu-header row">--}}
{{--        <h3 class="menu-header-name col-7">CHUYÊN MỤC</h3>--}}
{{--    </header>--}}
{{--    <div class="menu-list">--}}
{{--    @foreach($categoryShowMenu as $categoryChildren)--}}
{{--                <div class="menu-item">--}}
{{--                    <i class="menu-item-icon fa-solid fa-star"></i>--}}
{{--                    <a href="{{asset(url('posts-by-category-chil',['parent_id'=>$categoryChildren->chil_cate_id]))}}"--}}
{{--                       class="post_link">{{$categoryChildren->name}}--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--    @endforeach--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}
<!-- Menu pc -->
<div class="menu-bar-pc">
    <ul class="menu-pc-list container">
        <li class="menu-pc-item"><a href="/home" class="post_link">
                <i class="menu-pc-icon fa-solid fa-house"></i>
            </a></li>
        @php   @endphp
        @foreach($categoryNavBar as $categoryParent)
        <li class="menu-pc-item">
            <a href="{{asset(url('posts-by-category',['id'=>$categoryParent->cate_id]))}}"
               class="post_link" style="color: #FFFFFF">{{$categoryParent->category_name}}
            </a>
        </li>
        @endforeach
        <li style="position: relative;padding-right:5px" class="menu-pc-item">
                @auth
                    <p class="user_name">{{auth()->user()->usesr_name}}</p>
                @endauth
            @guest
                <i class="fa-solid fa-user"></i>
                <a href="/user-login" class="user-login-link">Đăng nhập</a>
            @endguest
        </li>
        @if (isset(auth()->user()->usesr_name))
        <div class="user-menu">
            <ul class="user-menu-list">
                <div class="menu-list-info">
                    <img class="info-avatar-user" src="{{ asset('avatar/picture/'.auth()->user()->avatar) }}" alt="">
                    <p class="user_name" style="margin-top: 10px">{{auth()->user()->usesr_name}}</p>
                </div>
                <li class="user-menu-list-item"><a href="{{route('user-info.show',['user_info'=>auth()->user()->u_id])}}" class="user-menu-item-link">Thông tin của tôi</a></li>
                <li class="user-menu-list-item"><a href="{{url('user-change-password')}}" class="user-menu-item-link">Đổi mật khẩu</a></li>
                <li class="user-menu-list-item"><a href="{{url('comment-is-user',['u_id'=>auth()->user()->u_id])}}" class="user-menu-item-link">Hoạt động bình luận</a></li>
                <li class="user-menu-list-item">
                    <a href="/logout" class="user-menu-item-link">Log out<i  style="margin-left : 10px" class="fa-solid fa-right-from-bracket"></i></a>
                </li>
            </ul>
        </div>
        @endif
        <li class="menu-pc-item menu-search"><i class="fa fa-search" aria-hidden="true"></i></li>
        <form action="{{url('search-posts')}}" method="get" class="form-search-box animate__animated animate__fadeInDown">
            <div class="form-search">
                <input type="search" name="keyword" class="input form-search-input" placeholder="Từ khóa...">
                <button class="search-btn">Tìm Kiếm</button>
            </div>
        </form>
        <li class="menu-pc-item showmenu-btn"><i class="menu-pc-icon show-menu fa-solid fa-bars"></i></li>
    </ul>
</div>
<!-- showmenu btn -->
<div class="show-menu-pc animate__animated animate__fadeIn">
    <div class="menu-category-wrapper">
        <div class="container">
            <div class="row">
                @foreach($categoryNavBar as $categoryParent)
                <div class="col-4">
                    <ul class="category-menu-list">
                        <li class="category-menu-item"><a href="{{asset(url('posts-by-category',['id'=>$categoryParent->cate_id]))}}" class="post_link">{{$categoryParent->category_name}}</a></li>
                        @foreach ($categoryParent->children_category as $chilcategory)
                            <li class="category-menu-item">
                                <a href="{{asset(url('posts-by-category-chil',['parent_id'=>$chilcategory->chil_cate_id]))}}"
                                   class="post_link">{{$chilcategory->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

