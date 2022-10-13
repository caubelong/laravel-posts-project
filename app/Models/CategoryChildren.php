<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class CategoryChildren extends Model
{
    use HasFactory;
    protected $table='category_childrens';
    protected $primaryKey='chil_cate_id';
    protected $fillable=['name','parent_id'];
    public function categories(){
        return $this->belongsTo(Category::class,'parent_id','cate_id');
    }
    public function posts(){
        return $this->hasMany(Posts::class,'category_id');
    }
    public function filterChildrenCategories($filters,$keyword=null){
        $categories = DB::table('category_childrens')
            ->join('categories','category_childrens.parent_id','=','categories.cate_id')
            ->orderBy('category_childrens.created_at','desc');
        if (!empty($filters)){
            $categories=$categories->where($filters);
        }
        if (!empty($keyword)){
            $categories=$categories->where(function ($query) use($keyword){
               $query->orwhere('name','like','%'.$keyword,'%');
            });
        }
        $categories= $categories->simplePaginate(8);
        return $categories;
    }
}
