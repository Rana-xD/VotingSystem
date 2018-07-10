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


//********************* Admin route ***************************
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
	
	Route::get('dashboard', 'Admin@index');
	Route::get('voter', function(){
		return view('admin.voter');
	});

	Route::get('voter', 'Admin@showVoterLists');
	Route::get('voter/add', 'Admin@showVoterForm')->name('users.add.form');
	Route::post('voter/add', 'Admin@addVoter')->name('user.add.submit');

	// Route::post('voter/add', function(){
	// 	return view('admin.meeting');
	// });

	Route::get('meeting', 'Admin\MeetingController@showMeetingLists')->name('meetings');
	Route::get('meeting/add', 'Admin\MeetingController@showCreateForm')->name('meetings.add.form');
	Route::post('meeting/add', 'Admin\MeetingController@addMeeting')->name('meeting.add.submit');
	Route::post('meeting/edit/{uuid}', 'Admin\MeetingController@updateMeeting')->name('meeting.edit.submit');
	Route::delete('meeting/delete', 'Admin\MeetingController@deleteMeeting')->name('meeting.delete');
	Route::get('meeting/details/{uuid}', 'Admin\MeetingController@detailsMeeting')->name('meetings.details');
	Route::post('meeting/details/resolution/add', 'Admin@addResolution')->name('resolution.add');

	Route::get('meeting/detailsmeeting', 'Admin\MeetingController@gotoDetailMeeting')->name('meetings.inDetail');
});

// ********************** User Route **********************

Route::post('userlogin','Users@login');
Route::get('meeting','Users@meeting')->middleware('user');
Route::post('meeting','Users@addVote')->middleware('user')->name('vote.add.submit');
Route::post('user/meeting', 'SubmitvoteController@index');
Route::get('userlogout','Users@logout');
Route::get('user/meeting', function(){
	return view('user.meetingdetail');
});
