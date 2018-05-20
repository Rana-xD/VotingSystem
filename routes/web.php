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

//['middleware' => ['admin'],
Route::group( ['middleware' => ['admin'], 'prefix' => 'admin'], function () {
	
	Route::get('dashboard', 'Admin@index');

	Route::get('meeting', 'Admin\MeetingController@showMeetingLists')->name('meetings');
	Route::get('meeting/add', 'Admin\MeetingController@showCreateForm')->name('meetings.add.form');
	Route::post('meeting/add', 'Admin\MeetingController@addMeeting')->name('meeting.add.submit');
	Route::get('meeting/edit/{uuid}', 'Admin\MeetingController@showEditForm')->name('meetings.edit.form');
	Route::post('meeting/edit/{uuid}', 'Admin\MeetingController@editMeeting')->name('meeting.edit.submit');
	Route::delete('meeting/delete', 'Admin\MeetingController@deleteMeeting')->name('meeting.delete');
});



Route::post('user/meeting', 'SubmitvoteController@index');

Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});