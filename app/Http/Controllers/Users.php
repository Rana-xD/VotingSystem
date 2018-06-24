<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use App\VoteMaster;
use App\Vote;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Users extends Controller
{
	

	public function login(Request $request)
	{
		if (User::where('username', '=', $request->username)->exists()) {
			if(MeetingUser::where([
				['meeting_uuid',$request->meetingid],
				['pin',$request->password]
			])->exists())
			{

				session(['username' => $request->username ]);
				session(['meeting_uuid' => $request->meetingid]);
				// return 'meeting and pin chekced';
				return redirect('meeting');
			}
			else {
				{
					return "meeting ot trov";
				}
			}
		}
		else
		{
			return "ot mean";
		}
	}

	public function meeting()
	{
		$username = session('username','default');
		$meeting_uuid = session('meeting_uuid','default');
		
		$voterInfo = VoterInfo::where('username', '=', $username)->first();
		$addresses = json_decode($voterInfo->address,true);
		$role = User::findOrFail($username)->role;
		
		$MeetingMaster = MeetingMaster::findOrFail($meeting_uuid);
		
		$vote_master = VoteMaster::where('meeting_uuid', '=', $meeting_uuid)->first();
		$resolutions = $vote_master->vote_setting;


		return view('user.meeting')->with([
			'meeting_master' => $MeetingMaster,
			'voterinfo'	=> $voterInfo,
			'addresses' => $addresses,
			'role' => $role,
			'resolutions' => $resolutions
		]);
	}

	public function addVote(Request $request){
		
		// $meeting_uuid = $request->meeting_uuid;
		// $username = $request->username;

		// $voteMasterExist = VoteMaster::where('meeting_uuid', '=', $meeting_uuid)->exists();
		// return $voteMasterExist;
		// if (VoteMaster::where('meeting_uuid', '=', $meeting_uuid)->exists()
		// 	&& User::where('username', '=', $username)->exists()){

		// $vote_master = VoteMaster::findOrFail($meeting_uuid);
		// return $vote_master;
		// $vote_master_id = $vote_master->id;

		$vote = new Vote;
		$vote->vote_master_id = $vote->fromVoteTemplate();
		$vote->username = $vote->voter();
		if($request->proxy == "isAppointed"){
			$vote->isAppointed = 1;
		}else{
			$vote->proxy = $request->proxyName;
		}
		// $vote->vote = $request->$request;
		$vote->save();
		return redirect('/');
		// }
		// return $meeting_uuid;
		// try {
		// 	$voteMasterObj = VoteMaster::where('meeting_uuid', '=' ,$meeting_uuid);
		// 	// $userObj = User::findOrFail($username);
		// } catch (ModelNotFoundException $e) {
		// 	$status = [
		// 		"code" => 404,
		// 		"message" => "Meeting doesn't exists."
		// 	];
		// 	return $request->expectsJson() ? response()->json([
		// 		"status" => $status
		// 	]) : redirect('/')->with("status", $status);
		// }
		

		// $vote = new Vote;
		// $vote->vote_master_id = 1;
		// $vote->username = '9901';
		// if($request->proxy == "isAppointed"){
		// 	$vote->isAppointed = 1;
		// }else{
		// 	$vote->proxy = $request->proxyName;
		// }
		// $vote->vote = $request-> json_endcode($request);
		// $vote->save();
		// return $vote;

		// if($vote) {
		// 	Session::flash('success', 'Vote Successfully Submitted.');
		// 	$status = [
		// 		'code' => 200,
		// 		'message' => 'Vote Successfully Submitted.'
		// 	];
		// } else {
		// 	Session::flash('error', 'Failed to submit Vote.');
		// 	$status = [
		// 		'code' => 417,
		// 		'message' => 'Failed to submit Vote.'
		// 	];
		// }

		// return $request->expectsJson() ? response()->json([
		// 	'status' => $status,
		// 	'meeting' => $meeting
		// ]) : redirect()->back()->with([
		// 	'status' => $status,
		// 	'meeting' => $meeting
		// ]);
	}

	public function logout()
	{
		session()->flush();
		return redirect('/');
	}
}
