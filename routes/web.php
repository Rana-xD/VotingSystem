<?php

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


//== Managing generate account user route  =========

Route::get('user/login', function(){
	return view('user.login');
});

Route::post('user/login', 'UserController@index' );

Route::get('user/login', function(){
	return view('user.login');
});

Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});

Route::post('user/meeting', 'SubmitvoteController@index');

// =================================================

//== Managing generate account Admin dashboard  =========

Route::get('dashboard', function(){
	return view('admin.dashboard');
});
