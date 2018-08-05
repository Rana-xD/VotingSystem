<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;
use App\MeetingUser;
use App\MeetingMaster;
use App\VoterInfo;
use App\VoteMaster;
use App\Vote;
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
			$request->address2,
			$request->address3,
			$request->address4
		];
		$voterinfo->address = json_encode($address);
		$voterinfo->name = $request->name;
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

		return back();
	}

	public function addResolution(Request $request)
	{
		$vote = new VoteMaster;
		
		$resolution = $request->resolutions;
		$meeting_uuid = $request->meeting_uuid;

		$existVote = $vote->where('meeting_uuid','=',$meeting_uuid)->first();
		if(!empty($existVote))
		{
			try{
				
				$existVote->vote_setting = $resolution;
				$existVote->save();
				
				$responseData = [
						"status" => [
							"code" => 200,
							"message" => "Successfully update resolution"
						]
					]; 
					return $request->expectsJson() ? response()->json($responseData) 
					: redirect()->back()->with($responseData);
			}
			catch(Exception $e)
			{
				$responseData = [
					"status" => [
						"code" => 400,
						"message" => $e->getMessage()
					]
				]; 
				return $request->expectsJson() ? response()->json($responseData) 
				: redirect()->back()->with($responseData);
			}
		}
		else
		{
			try{
				$vote->meeting_uuid = $meeting_uuid;
				$vote->vote_setting = $resolution;
				$vote->save();
				$responseData = [
					"status" => [
						"code" => 200,
						"message" => "Successfully add resolution"
					]
				]; 
				return $request->expectsJson() ? response()->json($responseData) 
				: redirect()->back()->with($responseData);
				}
				catch(Exception $e)
				{
					$responseData = [
						"status" => [
							"code" => 400,
							"message" => $e->getMessage()
						]
					]; 
					return $request->expectsJson() ? response()->json($responseData) 
					: redirect()->back()->with($responseData);
				}
		}
		
		
	}

	public function getMeetingReport($uuid){

		/* Check if uuid is existed */

		/* Get Users's info belong to meeting */
		$meeting_user = MeetingUser::where('meeting_uuid', '=', $uuid)->get();
		
		// build array for fetching user
		$username = array();
		for ($i=0; $i < $meeting_user->count() ; $i++) {
			array_push($username, (int)($meeting_user[$i]->username));
		}

		$users = new VoterInfo;
		$users = $users->whereIn('username', $username)->get();	

		/* Get vote result */
		$voteMaster = VoteMaster::where('meeting_uuid', '=', $uuid)->first();
		$voteMasterId = $voteMaster->id;

		$votes = Vote::where('vote_master_id', '=', $voteMasterId )->get();
		// dd($votes);
		$resolutions = json_decode($voteMaster->vote_setting, true);
		// dd($resolutions);
		
		$answer = [];
		$nominee = [];
		$arr = [];
		for ($i=0; $i < count($resolutions) ; $i++) { 
			
			$user_type;
			$for = $abstain = $against = $openvote = 0;

			for ($j=0; $j< count($votes) ; $j++) {

				$arr = json_decode($votes[$j]->vote, true);

				$user_type = $arr['user_type'];
				
				if ($user_type == 'SHARE_HOLDER'){
					
					$ans = $arr['answers'][$resolutions[$i]["uuid"]];

					if($ans == "for") {
						// dd("Hwl");
						$for++;
						continue;
					}
					if($ans == "against"){ 
						$against++; 
						continue;
					}
					if($ans == "abstain"){
						$abstain++;
						continue;
					}
					if($ans == "openvote"){
						$openvote++;
						continue;
					}
				}

				$answer[$resolutions[$i]["question"]]["shareholder"] = [
					"for" => $for,
					"against" => $against,
					"abstain" => $abstain,
					"openvote" => $openvote
				];
			}

			$amountfor = $amountabstain = $amountagainst = 0;
			// $resolution_answer = ["for", "against", "abstain"];
			for ($j=0; $j< count($votes) ; $j++) {

				$arr = json_decode($votes[$j]->vote, true);

				$user_type = $arr['user_type'];

				if($user_type == 'NOMINEE'){
					// dd($resolutions[$i]["uuid"]);
					if( array_key_exists($resolutions[$i]["uuid"] , $arr['answers'])){
					
						$ans = $arr['answers'][$resolutions[$i]["uuid"]];						
						$key = array_keys($ans);

						for ($k=0; $k < count($key); $k++) {
							
							if( $key[$k] == "for"){
								$amountfor += (int)$ans['for'];
								continue;
							}
							if( $key[$k] == "against"){
								$amountagainst += (int)$ans['against'];
								continue;
							}
							if( $key[$k] == "abstain"){
								$amountabstain += (int)$ans['abstain'];
								continue;
							}
						}
						
					}
				}

				$answer[$resolutions[$i]["question"]]["nominee"] = [
					"for" => $amountfor,
					"against" => $amountagainst,
					"abstain" => $amountabstain,
				];
			}
		}

		// dd($answer);

		return view('admin.reporting')->with([
			'users' => $users,
			'answers' => $answer,
			// 'resolutions' => $resolutions,
		]);
	}
}

// array:4 [▼ $arr
//   "a8467d65-d4a7-4b13-9fb7-90ed5781a402" => "for"
//   "8a06a647-8b67-4b59-a79b-9b100ea51281" => "against"
//   "dec94f0f-018a-4a26-852f-3a7e1ebdd62c" => "against"
//   "d550cc5c-9526-4da5-9918-e3b2cc77fb98" => "abstain"
// ]


// array:4 [▼
//   0 => array:2 [▼
//     "uuid" => "a8467d65-d4a7-4b13-9fb7-90ed5781a402"
//     "question" => "questtion resolution 1"
//   ]
//   1 => array:2 [▼
//     "uuid" => "8a06a647-8b67-4b59-a79b-9b100ea51281"
//     "question" => "questtion resolution 2"
//   ]
//   2 => array:2 [▼
//     "uuid" => "dec94f0f-018a-4a26-852f-3a7e1ebdd62c"
//     "question" => "questtion resolution 3"
//   ]
//   3 => array:2 [▼
//     "uuid" => "d550cc5c-9526-4da5-9918-e3b2cc77fb98"
//     "question" => "questtion resolution 4"
//   ]
// ]