<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

use App\Imports\UsersImport;
use App\Imports\UserInfosImport;
use Excel;
use App\User;
// use Ramsey\Uuid\Uuid;


// function barcodeNumberExists($number) {
//     // query the database and return a boolean
//     // for instance,it might look like this in Laravel
//     return User::where('userid', $number)->exists();
// }
// function generateBarcodeNumber() {
//     $number = mt_rand(100000000,999999999); // better than rand()
//     // call the same function if the barcode exists already
//     if (barcodeNumberExists($number)) {
//         return generateBarcodeNumber();
//     }
//     // otherwise,it's valid and can be used
//     return $number;
// }

class ImportUser extends Action
{

    protected $selector = '.import-post';
    public function handle(Request $request)
    {
        // $request ...
        $file =  $request->file('file');
        $year =  $request->get('year');
        try {
            // 处理逻辑...
            // $userid = generateBarcodeNumber();
            // $userid = Uuid::uuid4();
            // $User_array = Excel::import(new UsersImport(), $file);
            // return  $this->response()->success($year);
            Excel::import(new UserInfosImport($year), $file);
            return $this->response()->success('success!!')->refresh();
        } catch (Exception $e) {
            return $this->response()->error('error：'.$e->getMessage());
        }
        
    }

    public function form()
    {
        $this->date('year', 'Year')->format('YYYY')->required();
        $this->file('file','Choose a file')->rules('required', ['required' => 'You need to choose a file！！']);

    }
    
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post">导入</a>
HTML;
    }
}