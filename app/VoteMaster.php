<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteMaster extends Model
{
	public const NOMINEE_TYPE = 'NOMINEE';
	public const SHAREHOLDER_TYPE = 'SHARE_HOLDER';
	protected $table = 'vote_masters';
	protected $fillable = [
		'meeting_uuid',
		'vote_setting',
		'voter_role',
	];
    protected $casts = [
    	'vote_setting' => 'array',
    ]

    public function onMeeting() {
    	return $this->belongsTo('App\MeetingMaster', 'meeting_uuid', 'meeting_uuid');
    }
}
