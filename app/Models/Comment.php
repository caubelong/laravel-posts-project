<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $primarykey='cmt_id';
    protected $fillable=['post_id','user_id','content_cmt'];
    public function posts(){
        return $this->belongsTo(Posts::class,'post_id','p_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','u_id');
    }
}
