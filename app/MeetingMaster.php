<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VoteMaster;

class MeetingMaster extends Model
{
	protected $table = 'meeting_masters';
 	protected $keyType = 'string';
 	protected $primaryKey = 'meeting_uuid';

 	protected $fillable = [
 		'meeting_uuid',
 		'title',
 		'logo',
 		'date_of_meeting',
 		'location',
 		'document',
 		'content',
 	];

 	protected $dates = [
 		'date_of_meeting',
 		'created_at',
 		'updated_at',
 		'expired_date',
 	];

 	protected $casts = [
 		'document' => 'array',
 	];

 	public function members() {
 		return $this->hasMany('App\User', 'meeting_uuid');
 	}

 	public function isClosed() {
 		return $this->isExpired;
 	}

 	public function nomineeVoteTemplate() {
 		return $this->hasOne('App\VoteMaster', 'meeting_uuid')
 					->where('voter_role', '=', VoteMaster::NOMINEE_TYPE);
 	}

 	public function shareholderVoteTemplate() {
 		return $this->hasOne('App\VoteMaster', 'meeting_uuid')
 					->where('voter_role', '=', VoteMaster::SHAREHOLDER_TYPE);
 	}

 	public function votes() {
 		return $this->hasManyThrough(
 			'App\Vote', 
 			'App\VoteMaster',
 			'meeting_uuid',
 			'vote_master_id',
 			'meeting_uuid',
 			'id'
 		);
 	}

}
