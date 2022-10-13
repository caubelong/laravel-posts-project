@extends('admin.layout.app')
@section('title')
    <title>Posts index</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Bài viết theo danh mục</h1>
            <span class="active">{{$getPostIsCategory[0]->category->name}} / </span>
            <span >Dashboard</span>
        </div>
        <div class="main-categories" style="overflow-y: auto;height: 500px">
            <table class="table table-bordered table-categories">
                <thead>
                <tr style="text-align:center;">
                    <th scope="col">Stt</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mô tả tin</th>
                    <th scope="col">Ảnh mô tả</th>
                    <th scope="col">Trạng thái tin</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($getPostIsCategory as $post)
                        <tr style="overflow-y: scroll">
                            <th scope="row">{{$post->p_id}}</th>
                            <td class="td-post">
                                <a href="{{route('posts.show',['post'=>$post->p_id])}}" class="post-table-link">
                                    <p class="post-table-text">{{$post->title}}</p>
                                </a>
                            </td>
                            <td class="td-post"><p class="post-table-text">{{$post->description}}</p></td>
                            <td class="td-post" style="text-align: center">
                                <img class="posts-cover__img" src="{{asset('img/'.$post->cover_img)}}" alt="{{$post->title}}">
                            </td>
                            <td class="td-post" style="text-align: center">@if($post->option_show ===0) Ẩn @else Hiện @endif</td>
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
    {{-- <div class="paginate">
        {{$getPostIsCategory->links()}}
    </div> --}}
@endsection
