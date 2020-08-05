<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){
    return Redirect::to('/postersubmit');
    });
Route::get('/home',function(){
    return Redirect::to('/postersubmit');
    });
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::post('/home/{id}', 'HomeController@update')->name('homeupdate');
Route::get('/profile', 'UserInfoController@index')->name('profile');
Route::get('/profileshow', 'UserInfoController@show')->name('profile.show');
Route::post('/profileshow', 'UserInfoController@submit')->name('profile.submit');
Route::get('/courses', 'CoursesController@index')->name('courses');

Route::post('/profile/upload', 'UserInfoController@upload')->name('profileupload');
Route::post('/profile/{id}', 'UserInfoController@update')->name('profileupdate');

Route::get('/poster', 'PosterController@index')->name('poster');
Route::get('/poster/{poster}', 'PosterController@show')->name('poster.show');
Route::get('/poster/{poster}/cancel', 'PosterController@cancel')->name('poster.cancel');
Route::get('/poster/{poster}/likeit', 'PosterController@likeit')->name('poster.likeit');
Route::get('/postersubmit', 'PosterController@create')->name('poster.create');
Route::post('/postersubmit', 'PosterController@update')->name('poster.update');
Route::get('/postercomments/{poster}', 'PosterController@comments')->name('poster.comment');
Route::get('/postercommentshow/{poster}', 'PosterController@commentshow')->name('poster.commentshow');
// Route::get('/download', 'DownloadController@index')->name('download');
