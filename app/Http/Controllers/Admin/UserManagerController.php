<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;
class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('users')->simplePaginate(10);
        return view('admin.userManager.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $users = User::find($id);
        return view('admin.userManager.detail_user',compact('users'));
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
        $users = User::find($id);
        return view('admin.userManager.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserManagerRequest $request, $id)
    {
        //
        $request->validated();
        $generatedImg='';
        $img_cover_posts = User::find($id);
        if($request->avatar){
            $generatedImg = 'img'.time().'-'.$request->usesr_name.'.'.$request->avatar->extension(); // tao ten khac de luu vao db tranh trung anh
            $request->avatar->move(public_path('avatar/picture'),$generatedImg);
        }else{
            $generatedImg=$img_cover_posts->avatar;
        }
        $users = DB::table('users')
        ->where('u_id',$id)
        ->update([
            'usesr_name'=>$request->input('usesr_name'),
            'user_email'=>$request->input('user_email'),
            'avatar'=>$generatedImg,
            'phone'=>$request->input('phone'),
        ]);
        return redirect('admin/user-manager');
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
        $user = User::find($id);
        $user->delete();
        Session::flash('notify','xóa tài khoản người dùng thành công');
        return redirect('admin/user-manager');
    }
}
