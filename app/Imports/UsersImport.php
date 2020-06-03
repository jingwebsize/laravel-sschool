<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Hash;

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

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $userid;
    
    public function __construct(string $userid='')
    {
        $this->userid = $userid;
    }

    public function model(array $row)
    {
        $userid = generateBarcodeNumber();
        return new User([
            'name' => $row[0],
            'tel' => $row[4],
            'email' => $row[5],
            'password' => Hash::make('123456'), 
            'userid' => $userid,
        ]);
       
    }
}
