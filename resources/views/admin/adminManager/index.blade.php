@extends('admin.layout.app')
@section('title')
    <title>User Manager index</title>
@endsection
@section('content')
    <div id="main-content">
        <div class="main-header">
            <h1>Tài khoản người dùng</h1>
            <span class="active">Tin Tức/ </span>
            <span >Trang Quản lý tài khoản người dùng</span>
        </div>
        <div class="add-categories-btn">
            <a href="admin-manager/create" class="add-categories-link" style="cursor:pointer;">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <div class="main-categories" style="">
            @if(Session::has('notify'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notify') }}</p>
            @endif
            <table class="table table-bordered table-categories">
                <thead>
                <tr style="text-align:center;">
                    <th scope="col">Stt</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->admin_id}}</th>
                        <td class="td-post" style="text-align: center">
                            <a href="{{route('admin-manager.show',['admin_manager'=>$user->admin_id])}}" class="post-table-link">
                                {{$user->ad_name}}
                            </a>
                        </td>
                        <td class="td-post"><p class="post-table-text" style="text-align: center">{{$user->ad_email}}</p></td>
                        <td class="td-post"><p class="post-table-text" style="text-align: center">{{$user->role}}</p></td>
                        <td class="td-post" style="display: flex;height: 105px;justify-content: center">
                            <a href="{{route('admin-manager.edit',['admin_manager'=>$user->admin_id])}}"
                               class="fa-solid fa-pen-to-square action-categories-update-link
                                       action-categories action-categories-update">
                            </a>
                            <form action="{{route('admin-manager.destroy',['admin_manager'=>$user->admin_id])}}" style="margin-left:0.5rem" method="post">
                                @csrf @method('delete')
                                <button class="action-categories" onclick="return confirm('bạn có muốn xóa tài khoản quản trị này không?')">
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
            {{$users->links()}}
        </div>
@endsection
