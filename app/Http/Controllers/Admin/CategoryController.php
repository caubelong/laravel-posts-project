<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidatedCategories;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use function Sodium\add;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DB::table('categories')
            ->simplePaginate(5);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatedCategories $request)
    {
        //
        $request->validated();
        $categories = new Category();
        $categories->category_name=strtolower( $request->input('category_name'));
        $categories->save();
        Session::flash('notify','thêm mới danh mục lớn thành công');
        return redirect('admin/categories');
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

        $category= Category::find($id);
        return view('admin.category.edit',compact('category',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatedCategories $request, $id)
    {
        //
        $request->validated();
        $categories = DB::table('categories')
            ->where('cate_id',$id)
            ->update([
               'category_name'=>strtoupper($request->input('category_name')),
            ]);
            Session::flash('notify','sửa danh mục lớn thành công');
        return redirect('admin/categories');
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
        $category=Category::find($id);
        $category->delete();
        Session::flash('notify','xóa danh mục lớn thành công');
        return back();
    }
}
