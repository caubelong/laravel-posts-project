@extends('admin.layout.app')
@section('title')
    <title>Create Posts</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tin</h1>
            <span class="active">Tin / </span>
            <span >Thêm mới tin</span>
        </div>
        <div class="main-create_posts">
            @if($errors->any())
                <div class="error-form">
                    <h3 class="text-danger">Sửa các lỗi sau để đăng bài viết :</h3>
                    <ul class="list-group list-group-numbered">
                        @foreach($errors->all() as $err)
                            <li class="list-group-item text-danger mt-3">{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('posts.store')}}" method="post" id="form-post"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <textarea type="text" cols="2" rows="3" name="title"
                              class="form-control" placeholder="Tiêu đề...">@if(old('title')){{old('title')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Danh mục tin tức</label>
                    <select class="form-control" name="category_id">
                        <option class="optionGroup" selected disabled>Chọn danh mục</option>
                        @foreach($category as $cat)
                        <option value="{{$cat->chil_cate_id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ảnh mô tả</label>
                    <input type="file" name="cover_img" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Mô tả tin tức</label>
                    <textarea type="text" name="description" rows="4" cols="50" class="form-control" placeholder="Mô tả ...">@if(old('description')){{old('description')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Nội dung tin tức</label>
                    <textarea id="file-picker" name="body" rows="20" cols="50" class="form-control" rows="">@if(old('body')){{old('body')}}@endif</textarea>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái tin</label>
                    <select class="form-control" name="option_show">
                        <option class="optionGroup" selected disabled>Trạng thái tin</option>
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Thêm tin</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/fifjc9rr8z800stijt5dlgl185grxeplz9mwj75ajuau4s51/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            image_dimensions: false,
            image_class_list: [
                {title: 'Responsive', value: 'img-responsive'}
            ],
            image_description: true,
            image_caption: true,
            height:"600",
            selector: 'textarea#file-picker',
            plugins: 'code table lists image code ',
            toolbar: 'link image | code |image |undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];

                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    });
                    reader.readAsDataURL(file);
                });

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });

    </script>
@endsection
