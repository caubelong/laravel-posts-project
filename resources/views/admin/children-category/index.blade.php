@php
    use App\Models\Category;
@endphp
@extends('admin.layout.app')
@section('title')
<title>Index Categories</title>
@endsection
@section('style')
    <style>
        nav.flex.justify-between{
                margin-top: 9px;
                float: right;
            }
    </style>

@endsection
@section('content')
        <div id="main-content">
            <div class="main-header">
                <h1>Danh mục con</h1>
                <span class="active">Danh mục con / </span>
                <span >Dashboard</span>
            </div>
            <div class="add-categories-btn">
                <a href="children-categories/create" class="btn add-categories-link" style="cursor:pointer;">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <form class="form-filter-post mb-3" action="{{route('children-categories.index')}}" method="get">
                <div class="row" style="width: 100%">
                    <div class="col-3">
                        <select name="category"class="form-control">
                            <option class="optionGroup" selected disabled>Danh mục lớn</option>
                            <option class="optionGroup" value="0"  @if(request('category')==0)selected @endif >Tất cả danh mục</option>
                            @foreach($categories_parent as $category)
                                <option class="optionGroup" value="{{$category->cate_id}}"
                                        @if($category->cate_id== request('category'))selected @endif>
                                    {{$category->category_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7">
                        <input type="search" name="keyword" value="{{request('keyword')}}" class="form-control" placeholder="Tìm kiếm theo tên ">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                    </div>
                </div>
            </form>
                <div class="main-categories">
                    @if(Session::has('notify'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
                    @endif
                    <table class="table table-bordered table-categories">
                        <thead>
                        <tr style="text-align:center;text-transform: uppercase">
                            <th scope="col">Stt</th>
                            <th scope="col">Tên danh mục </th>
                            <th scope="col">Danh mục cha </th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key=> $category)
                        <tr>
                            <th scope="row" data-categoryid="{{$category->chil_cate_id}}">{{$key+1}}</th>
                            <td>{{$category->name}}</td>
                            @php $category_parent = Category::find($category->parent_id)->category_name @endphp
                            <td>{{$category_parent}}</td>
                            <td style="display: flex; justify-content: center;">
                                    <a href="{{route('children-categories.edit',['children_category'=>$category->chil_cate_id])}}"
                                       class="fa-solid fa-pen-to-square action-categories-update-link
                                       action-categories action-categories-update">
                                    </a>
                                <form action="{{route('children-categories.destroy',['children_category'=>$category->chil_cate_id])}}" style="margin-left:0.5rem" method="post">
                                    @csrf @method('delete')
                                    <button class="action-categories" onclick="return confirm('bạn có muốn xóa danh mục này không?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <div class="paginate">
                            {{$categories->links()}}
                        </div>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
@endsection

