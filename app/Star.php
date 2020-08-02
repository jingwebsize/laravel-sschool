<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Star extends Model
{
    //
    protected $fillable = [
        'id', 'posterid', 'userid'
    ];
}
