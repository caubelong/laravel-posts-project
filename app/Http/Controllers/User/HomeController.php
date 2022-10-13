<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ChildrenCategoryController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryChildren;
use App\Models\Posts;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryNavBar = Category::all();
        $categoryShowMenu = CategoryChildren::all();
        $postsNews = DB::table('posts')
            ->orderBy('created_at','desc')
            ->where('option_show','=', 1)
            ->limit(12)
            ->get();
        return view('user.home.index',compact(['postsNews','categoryNavBar','categoryShowMenu']));
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
//        $categoryNavBar = Category::all();
//        $categoryShowMenu = CategoryChildren::all();
        $posts = Posts::find($id);
        $comments= DB::table('comments')->where('post_id','=',$id)->get();
//        $getPostSameCategoryDetail = Posts::where('category_id','=',$posts->category_id)->inRandomOrder()->take(10)->get();
        return view('user.home.detail_posts',compact([
                    'posts',
                    'comments',
                ]));
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
//    function randoomPost(){
//        $postsRandoom = DB::table('posts')
//            ->where('option_show','=', 1)
//            ->inRandomOrder()->limit(6)->get()->toArray();
////        $categoryShowMenu = CategoryChildren::all()->toArray();
////        $categoryNavBar = Category::all()->toArray();
////        $headers=array(
////            array('categoryShowMenu'=>$categoryShowMenu),
////            array('categoryNavBar'=>$categoryNavBar),
////            array('postrandoom'=>$postsRandoom),
////        );
////        foreach ($headers[0] as $post){
////            dump($post['title']);
////        }
//        return $postsRandoom;
//    }
    public function getPostByCategory($id){
        if (!empty($id)){
           $categoryList = Category::find($id);
        }
        return view('user.home.PostByCategory',compact('categoryList',));
    }
    public function getPostByCategoryParent($id){
        if (!empty($id)){
            $categoryList = CategoryChildren::find($id);
        }
        return view('user.home.PostsByCategoryChil',compact('categoryList'));
    }
    public function searchPosts(Request $request){
        $posts=null;
        if (!empty($request->keyword)){
            $keyword = $request->keyword;
            $posts = DB::table('posts')->where(function ($query) use ($keyword){
                    $query->orwhere('title','like','%'.$keyword.'%');
            });
            $posts=$posts->get();
        }
        return view('user.home.PostSearch',compact('posts'));
    }
}
