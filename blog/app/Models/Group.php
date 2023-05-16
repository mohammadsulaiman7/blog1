<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
