<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use Auth;

class HomeController extends Controller
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
        if (!UserProfile::where('userid', $user->userid)->exists()) {
            UserProfile::create([
                'name' => $user->name,
                'tel' => $user->tel,
                'email' => $user->email,
                'userid' => $user->userid,
                'year' => date('Y'),
            ]);
        }
        $profile = $user->profile->last();
        // var_dump($user);
        // var_dump($profile->useid);
        if($profile->year!=date('Y')){
            $profile->button='Summit to Apply';
        }else{
            $profile->button='Confirm Modify';
        }
        return view('home',['user'=> $user,'profile'=>$profile]);
    }

    public function update(Request $request,$id)
    {
        $user= Auth::user();
        if (!UserProfile::where('userid', $user->userid)->where('year', date('Y'))->exists()) {
            $profile = new UserProfile($request->all());
            $profile->userid = $user->userid;
            $profile->year = date('Y');
            $profile->save();
        }else{
            $profile = UserProfile::find($id);
            $profile->fill($request->all());
            // var_dump($info);
            $profile->save();
        }
        return redirect('home');
    }
}
