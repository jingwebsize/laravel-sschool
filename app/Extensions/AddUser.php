<?php

namespace App\Extensions;
use App\User;

function barcodeNumberExists($number) {
    // query the database and return a boolean
    // for instance,it might look like this in Laravel
    return User::where('userid', $number)->exists();
}
function generateBarcodeNumber() {
    $number = mt_rand(100000000,999999999); // better than rand()
    // call the same function if the barcode exists already
    if (barcodeNumberExists($number)) {
        return generateBarcodeNumber();
    }
    // otherwise,it's valid and can be used
    return $number;
}
class AddUser
{
    protected $userid;
    public static function getid(){
        $userid = generateBarcodeNumber();
        return $userid;
    }
}
