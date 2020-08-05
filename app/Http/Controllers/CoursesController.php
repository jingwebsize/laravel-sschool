<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;

class CoursesController extends Controller
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
        $filename = Auth::user()->profile->addr.'.jpg';
        $flag = Storage::disk('userletter')->exists($filename);
        return view('courses', ['flag'=>$flag,'fileurl'=>'userletter/'.$filename]);
    }

}
