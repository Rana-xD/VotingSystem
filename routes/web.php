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


Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
	
	Route::get('dashboard', 'Admin@index');

	Route::get('meeting', 'Admin@meeting');

	Route::get('meeting/add', function(){
		return view('admin.createmeeting');
	});

	Route::post('meeting/add', function(){
		return view('admin.meeting');
	});

	Route::get('voter', function(){
		return view('admin.voter');
	});

	Route::get('voter/add', function(){
		return view('admin.createvoter');
	});

	// Route::post('voter/add', function(){
	// 	return view('admin.meeting');
	// });
});



Route::post('user/meeting', 'SubmitvoteController@index');

Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});