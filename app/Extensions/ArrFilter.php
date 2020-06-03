<?php

namespace App\Extensions;
class ArrFilter
{
    public static function make($val,$array){
        for ($i=0;$i<count($array);$i++) {
            if ($val == $array[$i]) {
                return $i+1;
            }
        }
        return 0;
    }
}