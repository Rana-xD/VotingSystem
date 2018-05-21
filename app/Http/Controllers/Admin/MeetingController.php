<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingRequest;
use App\MeetingMaster;
use App\User;
use Auth;
use Session;

class MeetingController extends Controller
{
	protected $paginate_num = 20;
	/**
	 * Show list of registered meeting.
	 * @param  Illuminate\Http\Request $request
	 * @return \View
	 */
	public function showMeetingLists(Request $request) {
		$meetings = MeetingMaster::orderBy('created_at', 'asc')
								->paginate($this->paginate_num);
		return view('admin.meeting.list_entries')->with([
			'meetings' => $meetings,
		]);
	}

    public function showCreateForm(Request $request) {
    	return view('admin.meeting.create');
    }

    public function addMeeting(StoreMeetingRequest $request) {
    	$this->authorize('create', MeetingMaster::class);

    	function getNonExistingUUID() {
    		$meeting_uuid = str_random(24);
	    	$existed = MeetingMaster::where('meeting_uuid', '=', $meeting_uuid)->count();
	    	if(!$existed) {
	    		return $meeting_uuid;
	    	} else {
	    		return getNonExistingUUID();
	    	}
    	}
    	$validated_data = $request->validated();
    	$validated_data['meeting_uuid'] = getNonExistingUUID();
    	$meeting = MeetingMaster::create($validated_data);
    	if($meeting) {
    		Session::flash('success', 'Successfully added a meeting.');
    		$status = [
    			'code' => 200,
    			'message' => 'Successfully added a meeting.'
    		];
    	} else {
    		Session::flash('error', 'Failed to add a meeting.');
    		$status = [
    			'code' => 417,
    			'message' => 'Failed to add a meeting.'
    		];
    	}

    	return $request->expectsJson() ? response()->json([
    		'status' => $status,
    		'meeting' => $meeting
    	]) : view('admin.meeting.edit')->with([
    		'status' => $status,
    		'meeting' => $meeting
    	]);
    }
}
