<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetCommentUserController extends Controller
{
    //
    public function getCommentIsUserId($id){
        $getCmtUser = DB::table('comments')
        ->join('posts', 'comments.post_id', '=', 'posts.p_id')
        ->join('users', 'comments.user_id','=','users.u_id')
        ->where('user_id','=',$id)
        ->get();
        // dd($getCmtUser);
        return view('admin.userManager.getComment',compact('getCmtUser'));
    }
}
