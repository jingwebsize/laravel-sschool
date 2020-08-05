<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;
use App\UserProfile;
use App\Extensions\ArrFilter;
use Hash;
use App\Extensions\AddUser;

class UserInfosImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    

    public function __construct(string $year)
    {
        $this->year = $year;
        // echo $year;
    }
    public function collection(Collection $rows)
    {
        //
        $genderarr = array('男','女');
        $gradearr = array('一年级','二年级','三年级','四年级及以上');
        $typearr = array('硕士','博士','硕博连读','博士后','青年教师');
        $user = new AddUser();
        for ($i=1;$i<count($rows,0);$i++)
        // foreach ($rows as $row) 
        {
            $userid = $user->getid();
            User::create([
                'name' => $rows[$i][0],
                'tel' => $rows[$i][4],
                'email' => $rows[$i][5],
                'password' => Hash::make($rows[$i][4]), 
                'userid' => $userid,
            ]);
            UserProfile::create([
                'name' => $rows[$i][0],
                'school' => $rows[$i][1],
                'sex' => ArrFilter::make($rows[$i][2],$genderarr),
                'birth' =>$rows[$i][3],
                'tel' => $rows[$i][4],
                'email' => $rows[$i][5],
                'tutor'=>$rows[$i][6],
                'major' =>$rows[$i][8],
                'grade' =>ArrFilter::make($rows[$i][9],$gradearr),
                'type' =>ArrFilter::make($rows[$i][10],$typearr),
                'addr' =>$rows[$i][11],
                'house' =>substr($rows[$i][11], 0, 1),
                'userid' => $userid,
                'year' => $this->year,
            ]);
        }
    }
}
