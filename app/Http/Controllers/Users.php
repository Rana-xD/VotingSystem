<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use App\VoteMaster;
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

	public function logout()
	{
		session()->flush();
		return redirect('/');
	}
}
