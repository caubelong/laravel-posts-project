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
                <h1>Categories</h1>
                <span class="active">Categories / </span>
                <span >Dashboard</span>
            </div>
            <div class="add-categories-btn">
                <a href="categories/create" class="btn add-categories-link" style="cursor:pointer;">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
                <div class="main-categories" style="overflow-y:auto ">
                    @if(Session::has('notify'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-class alert-danger">{{session('error')}}</div>
                    @endif
                    <table class="table table-bordered table-categories">
                        <thead>
                        <tr style="text-align:center;text-transform: uppercase">
                            <th scope="col">Stt</th>
                            <th scope="col">category name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key=> $category)
                        <tr>
                            <th scope="row" data-categoryid="{{$category->cate_id}}">{{$key+1}}</th>
                            <td>{{$category->category_name}}</td>
                            <td style="display: flex; justify-content: center;">
                                    <a href="{{route('categories.edit',['category'=>$category->cate_id])}}"
                                       class="fa-solid fa-pen-to-square action-categories-update-link
                                       action-categories action-categories-update">
                                    </a>
                                <form action="{{route('categories.destroy',['category'=>$category->cate_id])}}" style="margin-left:0.5rem" method="post">
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
                    {{$categories->links()}}
                </div>
{{--            form create categories modal --}}
{{--            <div class="col-lg-5 col-9 form-modal-category-create" id="form-modal-category">--}}
{{--                <span class="float-right close-form-category">--}}
{{--                    <i class="form-category-close-form__icon fa-solid fa-xmark"></i>--}}
{{--                </span>--}}
{{--                <h4 class="form-category-modal-title">Create Category</h4>--}}
{{--                <form id="createCategoryForm" action="{{route('categories.store')}}">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="CategoryName">Category Name:</label>--}}
{{--                        <input  name="category_name" value="{{old('category_name')}}"  type="text"--}}
{{--                                class="@error('category_name') is-invalid @enderror form-control"--}}
{{--                                id="CategoryName"--}}
{{--                                placeholder="Category Name..">--}}
{{--                        @error('category_name')--}}
{{--                            <div class="alert alert-danger error">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="selectCategory">Example select</label>--}}
{{--                        <select name="parent_id" class="form-control form-select form-select-sm"  id="selectCategory">--}}
{{--                            <option value="0">--}}
{{--                                Select Parent Categories--}}
{{--                            </option>--}}
{{--                            @foreach($parentCategories as $parentCategory)--}}
{{--                                <option class="option-parentid" value="{{$parentCategory->cate_id}}" data-parentid="{{$parentCategory->cate_id}}">--}}
{{--                                    {{$parentCategory->category_name}}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <button class="btn btn-danger btn-action-category-submit float-right" type="submit">Create</button>--}}
{{--                    @if($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            </div>--}}
{{--        --}}{{--            form edit categories modal --}}
{{--        <div class="col-lg-5 col-9 form-modal-category-edit" id="form-modal-category">--}}
{{--                <span class="float-right close-form-category">--}}
{{--                    <i class="form-category-close-form__icon fa-solid fa-xmark"></i>--}}
{{--                </span>--}}
{{--            <h4 class="form-category-modal-title">Update Category</h4>--}}
{{--            <form id="editCategoryForm">--}}
{{--                @csrf--}}
{{--                <input type="hidden" id="categoryId" name="cate_id">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="CategoryName">Category Name:</label>--}}
{{--                    <input  name="category_name" type="text"--}}
{{--                            class="@error('category_name') is-invalid @enderror form-control"--}}
{{--                            id="CategoryNameEdit"--}}
{{--                            placeholder="Category Name..">--}}
{{--                    @error('category_name')--}}
{{--                    <div class="alert alert-danger error">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="selectCategory">Example select</label>--}}
{{--                    <select name="parent_id" class="form-control form-select form-select-sm"  id="selectCategoryEdit">--}}
{{--                        <option value="0">--}}
{{--                            Select Parent Categories--}}
{{--                        </option>--}}
{{--                        @foreach($parentCategories as $parentCategory)--}}
{{--                            <option class="option-parentid" value="{{$parentCategory->cate_id}}" data-parentid="{{$parentCategory->cate_id}}">--}}
{{--                                {{$parentCategory->category_name}}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <button class="btn btn-danger btn-action-category-submit float-right" type="submit">Update</button>--}}
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
{{--@section('script')--}}
{{--    <script type="text/javascript">--}}
{{--        $('document').ready(()=>{--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            })--}}
{{--            //validate nếu k có lỗi thì sẽ submit form--}}
{{--            $('#createCategoryForm').validate({--}}
{{--                rules:{--}}
{{--                    "category_name":{--}}
{{--                        required:true,--}}
{{--                        minlength: 3,--}}
{{--                        maxlength:20--}}
{{--                    },--}}
{{--                },--}}
{{--                messages:{--}}
{{--                    "category_name":{--}}
{{--                        required:"Tên danh mục không được để trống",--}}
{{--                        minlength:"Tên danh mục tối thiểu phải có 3 kí tự",--}}
{{--                        maxlength:"Tên danh mục tối đa 20 ký tự"--}}
{{--                    }--}}
{{--                },--}}
{{--                //create category--}}
{{--                submitHandler: function(){--}}
{{--                    const formCategoriesEl = $('#createCategoryForm').serialize()--}}
{{--                    const url = $('#createCategoryForm').attr('action')--}}
{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        url: url,--}}
{{--                        data: formCategoriesEl,--}}
{{--                        dataType: 'json',--}}
{{--                        success:()=>{--}}
{{--                            $('.form-modal-category-create').removeClass('active')--}}
{{--                            $('#createCategoryForm')[0].reset()--}}
{{--                            location.reload()--}}
{{--                        }--}}
{{--                    });--}}
{{--                },--}}
{{--            })--}}
{{--            //update category--}}
{{--            $('#editCategoryForm').validate({--}}
{{--                rules:{--}}
{{--                    "category_name":{--}}
{{--                        required:true,--}}
{{--                        minlength: 3,--}}
{{--                        maxlength:20--}}
{{--                    },--}}
{{--                },--}}
{{--                messages:{--}}
{{--                    "category_name":{--}}
{{--                        required:"Tên danh mục không được để trống",--}}
{{--                        minlength:"Tên danh mục tối thiểu phải có 3 kí tự",--}}
{{--                        maxlength:"Tên danh mục tối đa 20 ký tự"--}}
{{--                    }--}}
{{--                },--}}
{{--                //update category--}}
{{--                submitHandler: function(){--}}
{{--                    const id = $('.action-categories-update').data('cateid')--}}
{{--                    // const url = $('#editCategoryForm').attr('action')--}}
{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        url: {{url('categories/edit')}},--}}
{{--                        data: {cate_id:id},--}}
{{--                        dataType: 'json',--}}
{{--                        success:()=>{--}}
{{--                            $('.form-modal-category-edit').removeClass('active')--}}
{{--                            $('#editCategoryForm')[0].reset()--}}
{{--                            location.reload()--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}
{{--            $('.btn-action-category-submit').click(e=>{--}}
{{--                const formCategoriesEl = $('#editCategoryForm').serialize()--}}
{{--                e.preventDefault()--}}
{{--                $(this).html('Seending...')--}}
{{--                $.ajax({--}}
{{--                    data:formCategoriesEl,--}}
{{--                    url:"{{url('categories/store')}}}",--}}
{{--                    type:"POST",--}}
{{--                    dataType:'json',--}}
{{--                    success:(data)=>{--}}
{{--                        $('.form-modal-category-edit').removeClass('active')--}}
{{--                        $('#editCategoryForm')[0].reset()--}}
{{--                        location.reload()--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--@endsection--}}
