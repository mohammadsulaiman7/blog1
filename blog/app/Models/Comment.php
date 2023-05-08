<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // public $timestamps=false;
    protected $guarded=[];
    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
