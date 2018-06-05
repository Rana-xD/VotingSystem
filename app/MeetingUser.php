<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingUser extends Model
{
    protected $fillable = [
        'username',
        'meeting_uuid',
    ];
    protected $hidden = ['pin'];

    public function forMeeting() {
		return $this->belongsTo('App\MeetingMaster', 'meeting_uuid', 'meeting_uuid');
	}

	
}
