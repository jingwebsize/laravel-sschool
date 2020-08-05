<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $guarded = [''];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid', 'user');
    }
    public function zans(){
        return $this->hasMany(Zan::class,'summaryid','id');
    }
    public function zan($userid){
        return $this->hasMany(Zan::class,'summaryid','id')->where('userid',$userid);
    }
}