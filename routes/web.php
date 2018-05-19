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

Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});

Route::post('user/meeting', 'SubmitvoteController@index');



Route::group(['middleware' => ['admin']], function () {
    
Route::get('/dashboard', 'Admin@index');
Route::get('admin/meeting', 'Admin@meeting');

Route::get('admin/meeting/create', function(){
	return view('admin.createmeeting');
    });

Route::post('admin/meeting/create', function(){
	return view('admin.meeting');
    });
});