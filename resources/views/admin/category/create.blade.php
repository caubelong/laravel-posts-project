@extends('admin.layout.app')
@section('title')
    <title>Create Categories</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Categories</h1>
            <span class="active">Categories / </span>
            <span >Dashboard</span>
        </div>
        <div class="main-categories">
           <div class="container">
               <div class="row">
                   <div class="col-lg-8 col-12" id="form-create-category">
                       <form method="post" action="{{route('categories.store')}}">
                           @csrf
                           <div class="form-group">
                               <label for="CategoryName">Category Name:</label>
                               <input name="category_name" value="{{old('category_name')}}" type="text" class="form-control" id="CategoryName" placeholder="Category Name..">
                           </div>
                           <button type="submit" class="btn btn-primary">Create</button>
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
