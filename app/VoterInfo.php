<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoterInfo extends Model
{
	protected $table = 'voter_infos';
	protected $fillable = [
   		'address',
   		'number_of_share',
   		'postal_code',
   	];

   	public function user() {
   		return $this->belongsTo('App\User', 'username', 'username');
   	}
}
