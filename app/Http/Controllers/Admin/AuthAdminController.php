<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthAdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logoutAdmin');
    }
    public function loginAdmin(Request $request){
        $request->validate([
            'ad_name'=>'required',
            'ad_password'=>'required'
        ],[
            'ad_name.required'=>'bạn chưa nhập tên tài khoản',
            'ad_password.required'=>'bạn chưa nhập mật khẩu',
        ]);
        $user_name=$request->input('ad_name');
        $password=$request->input('ad_password');
        if(Auth('admin')->attempt(['ad_name' => $user_name, 'password' => $password])) {
            Session::flash('notify','Đăng nhập thành công');
            return redirect('admin/categories');
        }else{
            Session::flash('notify','Tài khoản hoặc mật khẩu không chính sác');
            return redirect('login-admin');
        }
    }
    public function logoutAdmin(){
        Auth::guard('admin')
            ->logout();
        return redirect('/login-admin');
    }


}
