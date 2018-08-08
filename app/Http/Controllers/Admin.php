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
		$meetingMasterId = MeetingMaster::where('meeting_uuid', '=', $uuid)->first()->id;
		$meeting_user = Vote::where('vote_master_id','=', $meetingMasterId)->get();
		
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
		
		$resolutions = json_decode($voteMaster->vote_setting, true);
		
		$answer = [];
		$arr = [];
		$proxy = [];
		$voteBehavior = [];
		$temp = [];

		for ($i=0; $i < count($resolutions) ; $i++) { 
			
			$user_type;
			$for = $abstain = $against = $openvote = 0;
			$amountfor = $amountabstain = $amountagainst = 0;
			$proxyFor = $proxyAbstain = $proxyAgainst = 0;
			$appointPerson;

			for ($j=0; $j< count($votes) ; $j++) {

				$arr = json_decode($votes[$j]->vote, true);
				$user_type = $arr['user_type'];
				
				if ($user_type == "SHARE_HOLDER"){
					$ans = $arr['answers'][$resolutions[$i]["uuid"]];

					if($ans == "for") 		$for++;
					if($ans == "against")	$against++; 
					if($ans == "abstain")	$abstain++;
					if($ans == "openvote")	$openvote++;

					$answer[$resolutions[$i]["question"]]["shareholder"] = [
						"for" => $for,
						"against" => $against,
						"abstain" => $abstain,
						"openvote" => $openvote,
					];

					$hin = $votes[$j]->username;
					$name = VoterInfo::where('username', '=', $hin)->first()->name;
					$voteBehavior = [
						$name => [
							'proxy' => $appointPerson,
							'answers' => [
								$resolutions[$i]['question'] => [
									"for" => $for,
									"against" => $against,
									"abstain" => $abstain,
									"openvote" => $openvote,
								],
							],
						]
					];

					/* Calculating how holder votes */
					// for ($l=0; $l < count($resolutions) ; $l++) {
					// }

					/* Calculating percentage base on holder voted */
					$numOfHolder = count($users);
					$answer[$resolutions[$i]['question']]['percentage'] = [
						"for" => ($for * 100 ) / $numOfHolder,
						"against" => ($against * 100) / $numOfHolder,
						"abstain" => ($abstain * 100) / $numOfHolder,
						"openvote" => ($openvote * 100) / $numOfHolder,
					];
				}

				if($user_type == 'NOMINEE'){
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
						$answer[$resolutions[$i]["question"]]["nominee"] = [
							"for" => $amountfor,
							"against" => $amountagainst,
							"abstain" => $amountabstain,
						];
					}

					/* Calculating shares for each proxy */
					if( array_key_exists($resolutions[$i]["uuid"] , $arr['answers'])){
						if($votes[$i]->isAppointed){
							$appointPerson = 'Chairman';
							$proxy[$resolutions[$i]["question"]]["proxy"] = $appointPerson;

							$ans = $arr['answers'][$resolutions[$i]["uuid"]];
							$keys = array_keys($ans);

							for ($k=0; $k < count($keys); $k++) {

								if( $keys[$k] == "for"){
									$proxyFor += (int)$ans['for'];
									continue;
								}
								if( $keys[$k] == "against"){
									$proxyAgainst += (int)$ans['against'];
									continue;
								}
								if( $keys[$k] == "abstain"){
									$proxyAbstain += (int)$ans['abstain'];
									continue;
								}
							}
							
						}
					}
				}
				$proxy[$resolutions[$i]["question"]]['answers'] = [
					"for" => $proxyFor,
					"against" => $proxyAgainst,
					"abstain" => $proxyAbstain,
				];
			}
		}

		dd($voteBehavior);
		
		return view('admin.reporting')->with([
			'users' => $users,
			'answers' => $answer,
			'proxy' => $proxy,
		]);
	}
}