<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use Auth;
use Session;

class Admin extends Controller
{

	protected $paginate_num = 20;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		
		return view('admin.dashboard');
	}

	// Managing Voter action

	public function addVoter(Request $request)
	{
		$user = new User;
		$username = $request->username;
		$user->username = $username;
		$user->role =  $request->role;
		$user->save();
		$meeting_uuid = $request->meeting_uuid;
		try {
			$meetingObj = MeetingMaster::findOrFail($meeting_uuid);
		} catch (ModelNotFoundException $e) {
			$status = [
				"code" => 404,
				"message" => "Meeting doesn't exists."
			];
			return $request->expectsJson() ? response()->json([
				"status" => $status
			]) : redirect()->back()->with("status", $status);
		}

		$meeting_user = new MeetingUser;
		$pin = str_random(6);
		$meeting_user->pin = $pin;
		$meeting_user->meeting_uuid = $meetingObj->meeting_uuid;
		$meeting_user->username = $username;
		$meeting_user->save();

		$voterinfo = new VoterInfo;
		$voterinfo->username = $username;
		$address = [
			$request->address1,
			$request->address2
		];
		$voterinfo->address = json_encode($address);
		$voterinfo->number_of_share = $request->security;
		$voterinfo->postal_code = $request->postal_code;
		$voterinfo->save();

		$responseData = [
			"status" => [
				"code" => 200,
				"message" => "Successfully added a voter to a meeting."
			],
			"voter" => $meeting_user,
			"voterinfo" => $voterinfo
		]; 
		return $request->expectsJson() ? response()->json($responseData) 
		: redirect()->back()->with($responseData);
	}

	public function showVoterForm(Request $request)
	{

		// function getNonExistingUsername(String $username) {
		// 	// $username = $validated_data['username'];
		// 	$existed = User::where('username', '=', $username);
		// 	if(!$existed) {
		// 		return $username;
		// 	}
		// 	// } else {
		// 	// 	return view('admin.meeting.create');
		// 	// }
		// }

		// function pinExisted() {
		// 	$pin = random_int(100000, 999999);
		// 	$existed = MeetingUser::where('pin', '=', '$pin');
		// 	if(!$existed) {
		// 		return "$pin";
		// 	} else {
		// 		return pinExisted();
		// 	}
		// }
		
		// $user = new User;
		// $username = "$request->username";
		// $user->username = $username;
		// $user->role =  $request->role;
		// $user->save();

		// $meeting_user = new MeetingUser;
		// $pin = random_int(100000, 999999);
		// $meeting_user->pin = "$pin";
		// $meeting_user->meeting_uuid = "$request->meeting_uuid";
		// $meeting_user->username = "$username";
		// $meeting_user->save();

		// $voterinfo = new VoterInfo;
		// $voterinfo->username = "$username";
		// $address = [
		// 	$request->address1,
		// 	$request->address2
		// ];
		// $voterinfo->address = json_encode($address);
		// $voterinfo->number_of_share = $request->security;
		// $voterinfo->postal_code = "$request->postal_code";
		// $voterinfo->save();

		return back();
	}

	// public function showVoterLists(Request $request) {
	// 	$voter = User::orderBy('created_at', 'asc')
	// 							->paginate($this->paginate_num);
	// 	return view('admin.voter.list_entries')->with([
	// 		'voter' => $voter,
	// 	]);
	// }

	public function addResolution(Request $request)
	{
		
	}
}
