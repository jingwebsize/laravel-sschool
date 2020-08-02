<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Poster extends Model
{
    //
    use Commentable;
    protected $table = "posters";
    protected $fillable = ['title','imgurl','videourl','content','userid','username','isvideo','audiourl'];
    public function user(){
        return $this->belongsTo(User::class,'userid','userid');
    }
    public function stars(){
        return $this->hasMany(Star::class,'posterid','id');
    }
    public function starscount(){
        return $this->hasMany(Star::class,'posterid','id')->count();
    }
    public function star($userid){
        return $this->hasOne(Star::class,'posterid','id')->where('userid',$userid);
    }
}