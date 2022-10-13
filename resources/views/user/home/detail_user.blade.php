
@extends('user.layout.app')
@section('content-1')
    <div class="col-lg-8 col-12 content-left">
        <div class="main-create_posts" style="padding:10px;">
            <div style="display: flex;justify-content: space-between"><h5>Thông tin của tôi</h5>
                <span class="btn-edit-user btn btn-info" style="color:#fff;margin-bottom:10px">Chỉnh sửa thông tin<i class="btn-edit-icon fa-solid fa-user-pen"></i></span></div>
            @if($errors->any())
                <div class="error-form">
                    <h3 class="text-danger">Sửa các lỗi sau để tiếp tục :</h3>
                    <ul class="list-group list-group-numbered">
                        @foreach($errors->all() as $err)
                            <li class="list-group-item text-danger mt-3">{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('user-info.update',['user_info'=>auth()->user()->u_id])}}" method="post"id="form-post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên người dùng</label>
                    <input type="text" name="usesr_name" class="form-control input"
                           placeholder="Tên ngươi dùng..."  value="{{old('usesr_name')? old('usesr_name') : $users->usesr_name}}">
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <img src="{{asset('avatar/picture/'.$users->avatar)}}" style="width:100px;height: 100px" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="">Thay đổi ảnh đại diện</label>
                    <input type="file" name="avatar" class="form-control-file input">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="user_email"class="form-control" disabled
                           value="{{old('user_email')? old('user_email') : $users->user_email}} "
                           style="cursor: no-drop"
                           placeholder="Email ...">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="number" name="phone" class="form-control" disabled
                           value="{{old('phone')? old('phone') : $users->phone}}"
                           style="cursor: no-drop"
                           placeholder="Số điện thoại ...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-submit btn-primary float-right mb-3">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script>
    const inputFieldEl = document.querySelectorAll('.input')
    const btnEl = document.querySelector('.btn-submit')
    const btnEditEl = document.querySelector('.btn-edit-user')
    btnEl.disabled=true;
    inputFieldEl.forEach(input=>{
        input.disabled=true
        input.style.cursor='no-drop'
    })
   btnEditEl.addEventListener('click',()=>{
        inputFieldEl.forEach(input=>{
            input.disabled=false
            input.style.cursor='auto'
        })
        btnEl.disabled=false;
   })
    const errorFormEl = document.querySelector('.error-form')
    if (errorFormEl){
       inputFieldEl.forEach(input=>{
           input.disabled=false
           input.style.cursor='auto'
           btnEl.disabled=false;
       })
    }
</script>
@endsection
