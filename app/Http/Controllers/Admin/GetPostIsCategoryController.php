<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
class GetPostIsCategoryController extends Controller
{
    //
    public function getPostCategory($id){
        $getPostIsCategory = Posts::where('category_id','=',$id)->get();
        return view('admin/post/getpost_is_category',compact('getPostIsCategory'));
    
    }
}
