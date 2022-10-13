<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryChildren;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Posts extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $primaryKey='p_id';
    protected $fillable=['title','body','category_id','cover_img','description'];
    public function category(){
        return $this->belongsTo(CategoryChildren::class,'category_id','chil_cate_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id','p_id');
    }
    public function filterPost($filters,$keyword=null){
        DB::enableQueryLog(); // luu lai cau truy van sql
       $users = DB::table('posts')
           ->join('category_childrens','posts.category_id','=','category_childrens.chil_cate_id')
           ->join('categories','category_childrens.parent_id','=','categories.cate_id')
           ->orderBy('posts.created_at','desc');
       if(!empty($filters)){
           $users=$users->where($filters);
       }
       if(!empty($keyword)){
           $users=$users->where(function($query) use ($keyword){
                $query->orwhere('title','like','%'.$keyword.'%');
           });
       }
       $users=$users->simplePaginate(10);
       $sql= DB::getQueryLog(); // in ra truy van sql
       return $users;
    }
}
