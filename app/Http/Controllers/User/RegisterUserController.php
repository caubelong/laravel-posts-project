<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidatorUserRegister;
use App\Models\User;
use App\Http\Requests\ValidatorUserLogin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegisterUserController extends Controller
{
    //
    public function user_register (ValidatorUserRegister $request){
        $request->validated();
        $pw=$request->input('user_password');
        $user = new User();
        $user->usesr_name=$request->input('user_name');
        $user->user_email=$request->input('user_email');
        $user->user_password=Hash::make($pw);
        $user->phone=$request->input('phone');
        $user->save();
        Session::flash('notify','đăng ký tài khoản thành công');
        return redirect('user-login');
    }
    public function userAuthentication(ValidatorUserLogin $request)
    {
        $request->validated();
        $email=$request->user_email;
        $password=$request->user_password;
        if (Auth::attempt(['user_email' => $email, 'password' => $password])) {
           return redirect()->back();
        }else{
            Session::flash('notify','kiem tra lai thong tin');
            return redirect()->back();
        }
    }
}
