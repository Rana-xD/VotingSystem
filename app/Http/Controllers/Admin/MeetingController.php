<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\MeetingMaster;
use App\User;
use App\VoteMaster;
use App\MeetingUser;
use Auth;
use Session;
use DB;
use PDF;
class MeetingController extends Controller
{
	protected $paginate_num = 20;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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

        function getNonExistingUUID() {
            $meeting_uuid = random_int(100000, 999999); 
            $existed = MeetingMaster::where('meeting_uuid', '=', $meeting_uuid)->count();
            if(!$existed) {
                return $meeting_uuid;
            } else {
                return getNonExistingUUID();
            }
        }
        $meeting_uuid = getNonExistingUUID();

    	return view('admin.meeting.create')->with([
            'meeting_uuid' => $meeting_uuid
        ]);
    }

    public function addMeeting(StoreMeetingRequest $request) {
    	$this->authorize('create', MeetingMaster::class);
        
    	$validated_data = $request->validated();
    	$validated_data['meeting_uuid'] = $request->meeting_uuid;
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

    public function detailsMeeting(Request $request, $uuid)
    {
        try {
            $meeting = MeetingMaster::findOrFail($uuid);
			$users = User::where('role','!=', 'ADMIN')->get();
			$usersBelongToMeeting = DB::table('meeting_users')
									->join('users','meeting_users.username','=','users.username')
									->select('users.username','users.role','meeting_users.pin')
									->where('meeting_users.meeting_uuid','=',$uuid)
									->get();
		
			$vote = VoteMaster::where('meeting_uuid','=',$uuid)->first();
			
			

        } catch (ModelNotFoundException $e) {
            return redirect()->route('meetings');
        }
        return view('admin.meeting.detail')->with([
            'meeting' => $meeting,
			'users' => $users,
			'vote' => $vote,
			'usersBelongToMeeting' => $usersBelongToMeeting
		]);
    }

    public function updateMeeting(UpdateMeetingRequest $request, $uuid) {
        try{
            $meeting = MeetingMaster::find($uuid);
        } catch (ModelNotFoundException $e){
            $status = [
                'code' => 404,
                'message' => 'Meeting does not exists.'
            ];
            return $request->expectsJson() ? response()->json([
                'status' => $status
            ]) : redirect()->back()->with(['status' => $status]);
        }

        $validated_data = $request->validated();
        try {
            $meeting->update($validated_data);
        } catch (QueryException $e) {
            $status = [
                'code' => 505,
                'message' => 'Cannot update meeting now due to database connection interupted..'
            ];
            return $request->expectsJson() ? response()->json([
                'status' => $status
            ]) : redirect()->back()->with(['status' => $status]);
        } catch (Exception $e) {
            $status = [
                'code' => 500,
                'message' => 'Unknown error occured while update meeting, please retry.'
            ];
            return $request->expectsJson() ? response()->json([
                'status' => $status
            ]) : redirect()->back()->with(['status' => $status]);
        }

        $status = [
            'code' => 200,
            'message' => 'Successfully updated the meeting.'
        ];
        return $request->expectsJson() ? response()->json([
            'status' => $status
        ]) : redirect()->back()->with(['status' => $status]);
        

}

public function pdfDownload($uuid)
	{
		$usersBelongToMeeting = DB::table('meeting_users')
		->join('users','meeting_users.username','=','users.username')
		->select('users.username','users.role','meeting_users.pin')
		->where('meeting_users.meeting_uuid','=',$uuid)
		->get();
		$data = compact('usersBelongToMeeting');
		$pdf = PDF::loadView('pdf.userList', $data);
		return $pdf->download('download.pdf');
		// return view ('pdf.userList')->with([
		// 	'usersBelongToMeeting' => $usersBelongToMeeting
		// ]);
	}
}


