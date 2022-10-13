<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildrenCategoryValidator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryChildren;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChildrenCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryChildren;
    public function __construct(){
        $this->categoryChildren=new CategoryChildren();
    }
    public function index(Request $request)
    {
        //
//        $categoriesChildren=DB::table('category_childrens')->simplePaginate(10);
        $filters=[];
        $keyword=null;
        if (!empty($request->category)){
            $category =$request->category;
            $filters[]=['category_childrens.parent_id','=',$category];
        }
        if ($request->category==0){
            $filters[]=['category_childrens.parent_id','>',0];
        }
        if (!empty($request->keyword)){
            $keyword=$request->keyword;
        }
        $categories=$this->categoryChildren->filterChildrenCategories($filters,$keyword);
        $categories_parent = Category::all();
        return view('admin.children-category.index',compact('categories','categories_parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parentCategories= DB::table('categories')->get();
        return view('admin.children-category.create',compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildrenCategoryValidator $request)
    {
        //
        $request->validated();
        $childrenCategory = new CategoryChildren();
        $childrenCategory->name= strtolower($request->input('name'));
        $childrenCategory->parent_id=$request->input('parent_id');
        $childrenCategory->save();
        Session::flash('notify','thêm mới danh mục con thành công');
        return redirect('admin/children-categories');

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
        $parentCategories=DB::table('categories')->get();
        $childrenCategory=CategoryChildren::find($id);
        return view('admin.children-category.edit',compact('parentCategories','childrenCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChildrenCategoryValidator $request, $id)
    {
        $request->validated();
        $categoryChil = DB::table('category_childrens')->where('chil_cate_id',$id)
        ->update([
            'name'=>strtolower($request->input('name')),
            'parent_id'=>$request->input('parent_id'),
        ]);
        Session::flash('notify','sửa danh mục con thành công');
        return redirect('admin/children-categories');
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
        $categoryChildren=CategoryChildren::find($id);
        $categoryChildren->delete();
        Session::flash('notify','xóa danh mục con thành công');
        return redirect('admin/children-categories');
    }
}
