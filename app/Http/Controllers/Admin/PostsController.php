<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatedPosts;
use App\Models\Category;
use http\Message;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $posts;
    public function __construct(){
        $this->posts= new Posts();
    }
    public function index(Request $request)
    {
        //
//        $categoryByPost = DB::table('posts')
//            ->leftJoin('categories','posts.category_id','=','categories.cate_id')
//            ->select('p_id','title','cover_img','description','categories.category_name as categoryName')
//            ->simplePaginate(5);
        $filters=[];
        $keyword=null;
        if(!empty($request->status)){
            if ($request->status==1){
                $status=1;
            }else{
                $status=0;
            }
            $filters[]=['posts.option_show','=',$status];
        }
        if(!empty($request->category)){
            $category = $request->category;
            $filters[]=['category_childrens.parent_id','=',$category];
        }else{
            $category=0;
        }
        if(!empty($request->keyword)){
            $keyword = $request->keyword;

        }
        $postList = $this->posts->filterPost($filters,$keyword);
        // $categoryByPost=Posts::orderby('p_id','desc')->get();
        // $posts=DB::table('posts')->get();
//        dd($posts);
        $categories = Category::all();
        return view('admin.post.index',compact('postList','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = DB::table('category_childrens')
            ->get();
        return view('admin.post.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatedPosts $request)
    {
        //
        $request->validated();
        $generatedImg='';
        if($request->cover_img){
            $generatedImg = 'image'.time().'-'.$request->cover_img->extension();
            // tạo tên khác để lưu vào db tránh trùng ảnh
            $request->cover_img->move(public_path('img'),$generatedImg);
        }else{
            $generatedImg='imgEmpty.jpg';
        }
        $posts= new Posts();
        $posts->title=$request->input('title');
        $posts->category_id=$request->input('category_id');
        $posts->body=$request->input('body');
        $posts->cover_img=$generatedImg;
        $posts->description=$request->input('description');
        $posts->option_show=$request->input('option_show');
        $posts->save();
        Session::flash('notify','tạo tin mới thành công');
        return redirect('admin/posts');
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
//        $posts = DB::table('posts')
//            ->leftJoin('categories','posts.category_id','=','categories.cate_id')
//            ->select('posts.*','categories.category_name as categoryName')
//            ->where('p_id','=',$id)
//            ->get();
        $posts= Posts::find($id);
        return view('admin.post.detail',compact('posts'));
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
        $category = DB::table('category_childrens')
            ->get();
        $posts= Posts::find($id);
        return view('admin.post.edit',compact('category','posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatedPosts $request, $id)
    {
        //
        $request->validated();
        $img_cover_posts = Posts::find($id);
        $generatedImg='';
        if($request->cover_img){
            $generatedImg = 'img'.time().'-'.$request->cover_img->extension(); // tao ten khac de luu vao db tranh trung anh
            $request->cover_img->move(public_path('img'),$generatedImg);
        }else{
            $generatedImg=$img_cover_posts->cover_img;
        }
        $posts = DB::table('posts')
        ->where('p_id',$id)
        ->update([
            'title'=>$request->input('title'),
            'category_id'=>$request->input('category_id'),
            'cover_img'=>$generatedImg,
            'description'=>$request->input('description'),
            'body'=>$request->input('body'),
            'option_show'=>$request->input('option_show')
        ]);
        Session::flash('notify','Bài viết đã được chỉnh sửa');
        return redirect('admin/posts');
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
        $posts = Posts::find($id);
        $posts->delete();
        Session::flash('notify','Đã xóa bài viết');
        return redirect('admin/posts');
    }
    function replaceImg($title){
        $titleReplace = str_replace( array( '\'', '"',
            ',' , ';', '<', '>',':','!','/' ), '_',$title);
        return $titleReplace;
    }
}
