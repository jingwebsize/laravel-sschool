<?php
namespace App\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Extensions\ArrFilter;

class UsersExport extends ExcelExporter implements WithMapping
{
    protected $fileName = '用户列表.xlsx';

    protected $columns = [
        'id'        => 'ID',
        'name'      => '姓名',
        'tel'       => '手机',
        'email'     => '邮箱',
        'profile.sex'       => '性别',
        'profile.birth'     => '生日',
        'profile.school'    => '学校',
        'profile.tutor'     => '导师',
        'profile.major'     => '专业',
        'profile.grade'     => '年级',
        'profile.type'      => '类别',
    ];

    public function map($user) : array
    {
        $genderarr = array('男','女');
        $gradearr = array('一年级','二年级','三年级','四年级及以上');
        $typearr = array('硕士','博士','硕博连读','博士后','青年教师');
        return [
            $user->id,
            $user->name,
            $user->tel,
            $user->email,
            ArrFilter::make(data_get($user, 'profile.sex'),$genderarr),
            data_get($user, 'profile.birth'),
            data_get($user, 'profile.school'),
            data_get($user, 'profile.tutor'),
            data_get($user, 'profile.major'),
            ArrFilter::make(data_get($user, 'profile.grade'),$gradearr),
            ArrFilter::make(data_get($user, 'profile.type'),$typearr),
        ];
    }
}