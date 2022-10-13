
@extends('admin.layout.app')
@section('title')
    <title>Posts index</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tin Tức</h1>
            <span class="active">Tin Tức/ </span>
            <span >Trang trủ tin tức</span>
        </div>
        <div class="add-categories-btn">
            <a href="posts/create" class="add-categories-link" style="cursor:pointer;">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <form class="form-filter-post mb-3" action="{{route('posts.index')}}" method="get">
            <div class="row" style="width: 100%">
                <div class="col-3">
                    <select name="category"class="form-control">
                        <option class="optionGroup" selected disabled>Danh mục lớn</option>
                        <option class="optionGroup"  @if(request('category')==0)selected @endif  value="0" >Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option class="optionGroup" value="{{$category->cate_id}}"
                                    @if($category->cate_id== request('category'))selected @endif>
                                {{$category->category_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select name="status"class="form-control">
                        <option class="optionGroup" value="0" selected>Tất cả trạng thái</option>
                        <option class="optionGroup"value="1" @if(request('status')==1) selected @endif>Hiển thị</option>
                        <option class="optionGroup"value="inactive" @if(request('status')=='inactive') selected @endif>Không hiển thị</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="search" name="keyword" value="{{request('keyword')}}" class="form-control" placeholder="Tìm kiếm theo tiêu đề">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <div class="main-categories" style="">
            @if(Session::has('notify'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
            @endif
            <table class="table table-bordered table-categories">
                <thead>
                <tr style="text-align:center;">
                    <th scope="col">Stt</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Danh mục tin</th>
                    <th scope="col">Mô tả tin</th>
                    <th scope="col">Ảnh mô tả</th>
                    <th scope="col">Trạng thái tin</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($postList as $post)
                        <tr>
                            <th scope="row">{{$post->p_id}}</th>
                            <td class="td-post">
                                <a href="{{route('posts.show',['post'=>$post->p_id])}}" class="post-table-link">
                                    <p class="post-table-text">{{$post->title}}</p>
                                </a>
                            </td>
                            <td class="td-post" style="text-align: center"><a
                                href="{{url('admin/get-posts-categories',['category_id'=>$post->category_id])}}"
                                class="post-table-text post_link">{{ $post->name}}</a>
                            </td>
                            <td class="td-post"><p class="post-table-text">{{$post->description}}</p></td>
                            <td class="td-post" style="text-align: center">
                                <img class="posts-cover__img" src="{{asset('img/'.$post->cover_img)}}" alt="{{$post->title}}">
                            </td>
                            <td class="td-post" style="text-align: center;line-height:60px">{!! $post->option_show ==0
                                ?'<span class="btn btn-success btn-sm">Không hiển thị</span>':'<span class="btn btn-danger btn-sm">Hiển thị</span>'!!}</td>
                            <td class="td-post" style="display: flex;height: 105px;justify-content: center">
                                <a href="{{route('posts.edit',['post'=>$post->p_id])}}"
                                   class="fa-solid fa-pen-to-square action-categories-update-link
                                       action-categories action-categories-update">
                                </a>
                                <form action="{{route('posts.destroy',['post'=>$post->p_id])}}" style="margin-left:0.5rem" method="post">
                                    @csrf @method('delete')
                                    <button class="action-categories" onclick="return confirm('bạn có muốn xóa bài viết này không?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="paginate">
        {{$postList->links()}}
    </div>
@endsection
