<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

	use Notifiable;
	protected $keyType = 'string';
	protected $primaryKey = 'username';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'password', 'role', 'plain_password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'plain_password', 'password', 'remember_token',
	];

	const ADMIN_TYPE = 'ADMIN';
	const NOMINEE_TYPE = 'NOMINEE';
	const SHAREHOLDER_TYPE = 'SHARE_HOLDER';

	public function isAdmin()
	{
		return $this->role === self::ADMIN_TYPE;
	}

	public function isNominee() {
		return $this->role === self::NOMINEE_TYPE;
	}

	public function isShareHolder() {
		return $this->role === self::SHAREHOLDER_TYPE;
	}

	public function forMeeting() {
		return $this->belongsTo('App\MeetingMaster', 'meeting_uuid', 'meeting_uuid');
	}


}
