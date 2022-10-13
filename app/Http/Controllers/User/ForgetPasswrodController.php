<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePwRequest;
use App\Http\Requests\ForgetPwValidated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ForgetPasswrodController extends Controller
{
    //
    function checkUserForgetPw(ForgetPwValidated $request){
        $request->validated();
        $users = User::where('user_email','=',$request->user_email)
            ->where('phone','=',$request->phone)
            ->first();
        if($users){
            return view('user.auth.changePw')->with('users',$users);
        }else{
            Session::flash('notify','không tìm thấy tài khoản của bạn, kiểm tra lại thông tin');
            return redirect()->back();
        }
    }

    function changePw(ChangePwRequest $request){
        $request->validated();
        $users = DB::table('users')
        ->where('u_id',$request->u_id)
        ->update([
           'user_password'=>Hash::make($request->input('user_password')),
        ]);
        if($users){
            Session::flash('notify','đổi mật khẩu thành công, hãy đăng nhập lại');
            return redirect('/user-login');
        }
    }
}
