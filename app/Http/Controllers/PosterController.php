<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Comment;
use App\Poster;
use App\Star;
use Auth;
class PosterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posters = Poster::orderBy('created_at','desc')->where('flag', '2')->withCount(['comments','stars'])->paginate(20);
        // if($info->url){$info->payurl = Storage::disk('userimg')->url($info->url);}
        // if($info->fileurl){$info->fileurl = Storage::disk('userfile')->url($info->file);}
        return view('poster',['posters'=>$posters]);
    }
    public function show(Poster $poster)
    {
        // $poster = Poster::where('id',$id)->get();
        return view('posterdetail',['poster'=>$poster]);
    }

    public function create()
    {
        if (Poster::where('userid', Auth::user()->userid)->exists()) {
            $poster = Poster::where('userid', Auth::user()->userid)->first();
            $postertag = 0;
            // var_dump($poster);
        }else{
            $poster = new Poster;
            $postertag = 1;
        }
        return view('postersubmit',['poster'=>$poster,'postertag'=>$postertag]);
    }
    public function update(Request $request)
    {
        // $poster = Poster::where('id',$id)->get();
        if (!Poster::where('userid',Auth::user()->userid)->exists()) {
            $poster = new Poster;
            $poster->userid = Auth::user()->userid;
            $poster->flag = 1;
            $poster->fill($request->only(['title','imgurl', 'videourl','isvideo','audiourl']));
            $poster->save();
        }else{
            $poster = Poster::where('userid',Auth::user()->userid)->first();
            $poster->flag = 1;
            $poster->fill($request->only(['title','imgurl', 'videourl','isvideo','audiourl']));
            $poster->save();
        }
        return redirect('postersubmit');
    }

    public function likeit(Poster $poster){
        $params = [
            'userid'=>Auth::user()->userid,
            'posterid'=>$poster->id
        ];
        Star::FirstOrCreate($params);
        // return back();
        return "star";
    }
    public function cancel(Poster $poster){
        $poster->star(Auth::user()->userid)->delete();
        // return back();
        return "delete";
    }

    public function comments(Poster $poster)
    {
        // $poster = Poster::where('id',$id)->get();
        return view('postercomments',['poster'=>$poster]);
        // return $poster->comments;
    }
    public function commentshow(Poster $poster)
    {
        // $poster = Poster::where('id',$id)->get();
        return view('postercommentshow',['poster'=>$poster]);
    }

}
