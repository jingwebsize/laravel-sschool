<?php

namespace App\Imports;

use App\UserProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Extensions\ArrFilter;

class UserInfoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $userids;
    
    public function __construct(array $userids)
    {
        $this->userid = $userids;
    }


    public function model(array $row)
    {
 
        $genderarr = array('男','女');
        $gradearr = array('一年级','二年级','三年级','四年级及以上');
        $typearr = array('硕士','博士','硕博连读','博士后','青年教师');
        return new UserProfile([
            //
            'name' => $row[0],
            'school' => $row[1],
            'sex' => ArrFilter::make($row[2],$genderarr),
            'birth' =>$row[3],
            'tel' => $row[4],
            'email' => $row[5],
            'tutor'=>$row[6],
            'major' =>$row[7],
            'grade' =>ArrFilter::make($row[8],$gradearr),
            'type' =>ArrFilter::make($row[9],$typearr),
            'userid' => $this->userids[0],
        ]);
    }
}
