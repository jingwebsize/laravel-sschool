<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\User;
use App\UserInfo;
use Auth;

class UserInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user= Auth::user();
        if (!UserInfo::where('userid', $user->userid)->exists()) {
            UserInfo::create([
                'name' => $user->name,
                'userid' => $user->userid,
                'year' => date('Y'),
            ]);
        }else{

        }
        $info = UserInfo::where('userid', $user->userid)->first();
        // if($info->url){$info->payurl = Storage::disk('userimg')->url($info->url);}
        // if($info->fileurl){$info->fileurl = Storage::disk('userfile')->url($info->file);}
        return view('info',['info'=>$info]);
    }

    public function upload(Request $request)
    {
            if ($request->isMethod('POST')) { 
                $filename0 = $request->get('filename');
                $filetype = $request->get('filetype');
                $fileCharater = $request->file($filename0);
     
                if ($fileCharater->isValid()) { //括号里面的是必须加的哦
                    //如果括号里面的不加上的话，下面的方法也无法调用的
     
                    //获取文件的扩展名 
                    $ext = $fileCharater->getClientOriginalExtension();
     
                    //获取文件的绝对路径
                    $path = $fileCharater->getRealPath();
     
                    //定义文件名
                    // $filename = date('Ymdhis').'.'.$ext;
                    $filename=$fileCharater->getClientOriginalName();

                    //data
                    $data = array(
                        'filename'=>$filename,
                    );
                    //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
                    if(Storage::disk($filetype)->exists($filename)){
                        $filename = date('Ymdhis').'.'.$ext;
                    }
                    Storage::disk($filetype)->put($filename, file_get_contents($path));
                    return response()->json($data,200); 
                }else{
                    return response()->json(null,204); 
                }
                
            }else{
                return response()->json(null,204); 
            }
                    
    }
    public function update(Request $request,$id)
    {
        $info = UserInfo::find($id);
        $info->fill($request->only(['url', 'tsize', 'file']));
        var_dump($info);
        $info->save();
        return redirect('profile');
    }
}
