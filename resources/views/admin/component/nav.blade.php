@php
    $routeEl =array(
        "categories"=>array(
            'route_link'=>'categories.index',
            'routeActiveClass'=>'admin/categories*',
            'routeName'=>'Danh mục lớn',
            'icon'=>'fa-solid fa-table'
        ),
        "categories-children"=>array(
            'route_link'=>'children-categories.index',
            'routeActiveClass'=>'admin/children-categories*',
            'routeName'=>'Danh mục con',
            'icon'=>'fa-solid fa-table'
        ),
        "posts"=>array(
            'route_link'=>'posts.index',
            'routeActiveClass'=>'admin/posts*',
            'routeName'=>'Bài Viết',
            'icon'=>'fa-solid fa-newspaper'
        ),
        "UserManager"=>array(
            'route_link'=>'user-manager.index',
            'routeActiveClass'=>'admin/user-manager*',
            'routeName'=>'Tài khoản người dùng',
            'icon'=>'fa-solid fa-users'
        ),
    )
@endphp
<nav class="col-xl-2 col-md-4 col-sm-3 col-7 nav-container" id="nav-container" style="position: fixed;bottom: 0;right: 0;width: 300px;">
    <a href="#" class="brand-link">
        <img src="{{asset('../picture/AdminLTELogo.png')}}" class="brand-link-img" alt="brand images">
        <span class="brand-link-name">Trang Tin Tức</span>
    </a>
    <div class="slider-bar">
        <div class="user-panel">
            <img class="user-avatar" src="{{asset('../picture/user2-160x160.jpg')}}" alt="user img">
            <span class="user-name">{{auth('admin')->user()->ad_name}}</span>
        </div>
        <div class="form-search">
            <div class="input-group">
                <input class="form-control-sliderbar" type="text" placeholder="Search">
                <button class="input-group-btn">
                    <i class="input-group-btn-icon fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <nav class="nav-list-menu">
            <ul class="list-menu">
                @foreach ($routeEl as $route)
                    <li class="list-menu-item {{(request()->is($route['routeActiveClass'])) ?'active' :''}}">
                        <a href="{{route($route['route_link'])}}" class='list-menu-item-link'>
                            <i class="{{$route['icon']}}"></i>
                            {{$route['routeName']}}
                        </a>
                    </li>
                @endforeach
                @if(auth('admin')->user()->role=='admin')
                    <li class="list-menu-item {{(request()->is('admin/admin-manager*')) ?'active' :''}}">
                        <a href="{{route('admin-manager.index')}}"  class='list-menu-item-link'>
                            <i class="fa-solid fa-lock"></i>
                            Tài khoản người quản lý
                        </a>
                    </li>
                    @endif
                    @if(auth('admin')->user()->role=='admin')
                        <li class="list-menu-item">
                            <a href="{{url('admin/admin-change-pw')}}"  class='list-menu-item-link'>
                                <i class="fa-solid fa-lock"></i>
                                    Đổi mật khẩu admin
                            </a>
                        </li>
                    @endif
                    <li class="list-menu-item">
                        <a href="{{url('admin/logout')}}" class='list-menu-item-link'>
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Đăng xuất
                        </a>
                    </li>
            </ul>
        </nav>
    </div>
</nav>
