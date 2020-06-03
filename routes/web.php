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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/{id}', 'HomeController@update')->name('homeupdate');
Route::get('/profile', 'UserInfoController@index')->name('profile');
Route::post('/profile/upload', 'UserInfoController@upload')->name('profileupload');
Route::post('/profile/{id}', 'UserInfoController@update')->name('profileupdate');
Route::get('/courses', 'CoursesController@index')->name('courses');
