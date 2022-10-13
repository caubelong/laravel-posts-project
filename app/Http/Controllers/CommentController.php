<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{
    //
    public function pushComment(Request $request){
            $request->validate([
                'content_cmt'=>'required'
            ]);
            $comment = new Comment();
            $comment->post_id= $request->input('post_id');
            $comment->user_id=Auth::user()->u_id;
            $comment->content_cmt=$request->input('content_cmt');
            $comment->save();
            return redirect()->back();
    }
    public function destroyComment($id){
        $comment = DB::table('comments')->where('cmt_id','=',$id)->delete();
        return redirect()->back();
    }
}
