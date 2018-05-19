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
    return view('user.login');
});

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

Route::get('/home', 'HomeController@index')->name('home');


//== Managing generate account user route  =========

// Route::get('user/login', function(){
// 	return view('user.login');
// });

Route::post('user/login', 'UserController@index' );


Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});

Route::post('user/meeting', 'SubmitvoteController@index');

// =================================================

//== Managing generate account Admin dashboard  =========

Route::get('dashboard', 'Admin@index')->middleware('admin');

//=========== test ==============
Route::get('test/dashboard', function(){
	return view('admin.dashboard');
});

Route::get('test/meeting', function(){
	return view('admin.meeting');
});

Route::get('test/meeting/create', function(){
	return view('admin.createmeeting');
});

Route::post('test/meeting/create', function(){
	return view('admin.meeting');
});

Route::get('test/user', function(){
	return view('admin.users');
});


//==================================

