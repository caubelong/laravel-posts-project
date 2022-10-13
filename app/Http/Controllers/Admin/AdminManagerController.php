<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatorAdminAccount;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = Admin::where('role','=','manager')->paginate(10);
        return view('admin.adminManager.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.adminManager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatorAdminAccount $request)
    {
        //
        $request->validated();
        $admin = new Admin();
        $admin->ad_name= $request->input('ad_name');
        $pw = $request->input('ad_password');
        $admin->ad_password=Hash::make($pw);
        $admin->ad_email=$request->input('ad_email');
        $admin->role=$request->input('role');
        $admin->save();
        Session::flash('notify','thêm mới tài khoản quản trị thành công');
        return redirect('admin/admin-manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admins = Admin::find($id);
        return view('admin.adminManager.edit',compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'ad_password'=>'required|max:20|min:5|',
            'role'=>'required',
        ]);
        $pw = $request->input('ad_password');
        $admins = DB::table('admins')
            ->where('admin_id',$id)
            ->update([
                'ad_password'=>Hash::make($pw),
                'role'=>$request->input('role')
            ]);
        Session::flash('notify','sửa tài khoản quản trị thành công');
        return redirect('admin/admin-manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admins = Admin::find($id);
        $admins->delete();
        Session::flash('notify','thêm mới tài khoản quản trị thành công');
        return redirect('admin/admin-manager');
    }
    public function changePwIndex(){
        return view('admin.auth.changePw');
    }

    public function changePw(Request $request){
        $request->validate([
            'old_password' => 'required',
            'ad_password' => 'required||max:20|min:5|confirmed',
            'ad_password_confirmation'=>'required'
        ],[
            'old_password.required'=>'bạn chưa nhập mật khẩu cũ',
            'ad_password.max'=>'mật khẩu không vượt quá 20 ký tự',
            'ad_password.min'=>'mật khẩu không nhỏ hơn 5 ký tự',
            'ad_password.confirmed'=>'mật khẩu không khớp'
        ]);
            $pw = $request->input('ad_password');
       #Match The Old Password
        if(!Hash::check($request->old_password, auth('admin')->user()->ad_password)){
            return back()->with("error", "Mật khẩu cũ không đúng");
        }
        #Update the new Password
        Admin::where('admin_id','=',auth('admin')->user()->admin_id)->update([
            'ad_password' => Hash::make($pw)
        ]);
        return back()->with("status", "Đổi mật khẩu thành công");
    }
}
