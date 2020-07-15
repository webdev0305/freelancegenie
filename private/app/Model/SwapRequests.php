<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SwapRequests extends Model
{
    public function Jobs()
	{
		return $this->belongsTo('App\Model\Jobs','job_id');
	}
	public function User()
	{
		return $this->belongsTo('App\User','from_tutor_id');
	}
}
