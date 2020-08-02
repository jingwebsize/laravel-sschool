<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = [
        'userid','name','school','sex', 'birth','tel','email','tutor','major','grade','type','year','idcard','reason','file','addr','house'
    ];
    protected $guarded = [''];
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid', 'user');
    }
}
