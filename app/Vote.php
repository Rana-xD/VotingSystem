<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
    	'vote',
    	'proxy',
    	'isAppointed',
    ];
    protected $casts = [
    	'vote' => 'array',
    ];

    public function voter() {
    	return $this->belongsTo('App\User', 'username', 'username');
    }

    public function fromVoteTemplate() {
    	return $this->belongsTo('App\VoteMaster', 'vote_master_id');
    }
}
