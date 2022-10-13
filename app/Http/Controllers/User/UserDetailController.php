<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use App\Models\Category;
use App\Models\CategoryChildren;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $categoryNavBar = Category::all();
        $categoryShowMenu = CategoryChildren::all();
        $users = User::find($id);
        return view('user.home.detail_user',compact('users','categoryNavBar','categoryShowMenu'));
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
            'usesr_name'=>'required|max:30|min:3',
        ],
        [
            'usesr_name.required'=>'vui lòng nhập tên người dùng',
            'usesr_name.max'=>'tên người dùng không được vượt quá 30 ký tự',
            'usesr_name.min'=>'tên người dùng không được nhỏ hơn 3 ký tự',
        ]);
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
            'avatar'=>$generatedImg,
        ]);
        return redirect()->back();
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
    }
    public function changeUserPassword(){
        return view('user.auth.changePwIsLogin');
    }
    public function updateUserPassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'user_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->user_password)){
            return back()->with("error", "Mật khẩu cũ không đúng");
        }

        #Update the new Password
        User::where('u_id','=',auth()->user()->u_id)->update([
            'user_password' => Hash::make($request->user_password)
        ]);
        return back()->with("status", "Đổi mật khẩu thành công");
    }
    public function getCommentIsUser($id){
        $categoryNavBar = Category::all();
        $categoryShowMenu = CategoryChildren::all();
        $getCmtUser = DB::table('comments')
            ->join('posts', 'comments.post_id', '=', 'posts.p_id')
            ->join('users', 'comments.user_id','=','users.u_id')
            ->where('user_id','=',$id)
            ->get();
        return view('user.home.getCmtUser',compact('categoryNavBar','categoryShowMenu','getCmtUser'));
    }
}

