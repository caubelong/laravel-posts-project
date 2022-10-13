@extends('admin.layout.app')
@section('title')
    <title>Create Categories children</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Danh mục nhỏ</h1>
            <span class="active">Danh mục nhỏ/ </span>
            <span >Dashboard</span>
        </div>
        <div class="main-categories">
           <div class="container">
               <div class="row">
                   <div class="col-lg-8 col-12" id="form-create-category">
                       <form method="post" action="{{route('children-categories.store')}}">
                           @csrf
                           <div class="form-group">
                               <label for="CategoryName">Tên danh mục:</label>
                               <input name="name" value="{{old('name')}}" type="text" class="form-control" id="CategoryName" placeholder="Tên danh mục nhỏ..">
                           </div>
                           <div class="form-group">
                               <label for="selectCategory">Chọn danh mục lớn</label>
                               <select name="parent_id" class="form-control form-select form-select-sm"  id="selectCategory">
                                   <option hidden value="">Danh mục lớn</option>
                                   @foreach($parentCategories as $parentCategory)
                                       <option value="{{$parentCategory->cate_id}}">
                                           {{$parentCategory->category_name}}
                                       </option>
                                   @endforeach
                               </select>
                           </div>
                           <button type="submit" class="btn btn-primary">Thêm</button>
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
               </div>
           </div>
        </div>
    </div>
@endsection


