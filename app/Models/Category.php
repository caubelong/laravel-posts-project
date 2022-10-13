<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryChildren;
class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $primaryKey='cate_id';
    protected $fillable=['category_name'];
    public function children_category(){
        return $this->hasMany(CategoryChildren::class,'parent_id');
    }
    public function listPostsIsCategory(){
        return $this->hasManyThrough(Posts::class,CategoryChildren::class,'parent_id','category_id','cate_id');
    }
}
