<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use App\VoteMaster;
use \App\Vote;
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
		$documents = $vote_master->document;

		return view('user.meeting')->with([
			'meeting_master' => $MeetingMaster,
			'voterinfo'	=> $voterInfo,
			'addresses' => $addresses,
			'role' => $role,
			'resolutions' => $resolutions,
			'documents' => $documents
		]);
	}

	public function addVote(Request $request){

		try{
			$vote_master = VoteMaster::where("meeting_uuid", "=", $request->meeting_uuid)->first();
		}catch(ModelNotFoundException $e){
			$status = [
				"code" => 404,
				"message" => "Meeting does not exist."
			];
			return $request->expectsJson() ? response()->json([
				"status" => $status
			]) : redirect()->back()->with("status", $status);
		}

		$vote = new Vote;
		$vote->vote_master_id =  $vote_master->id; 
		$vote->username = $request->username ;

		if($request->proxy == "isAppointed"){
			$vote->isAppointed = 1;
		}else{
			$vote->proxy = $request->proxyName;
		}
		$vote->vote = $request->$request;
		$vote->save();

		$responseData = [
			"status" => [
				"code" => 200,
				"message" => "Vote successfully submitted."
			]
		]; 

		return $request->expectsJson() ? response()->json($responseData) 
		: redirect()->back()->with($responseData);
	}

	public function logout()
	{
		session()->flush();
		return redirect('/');
	}
}
