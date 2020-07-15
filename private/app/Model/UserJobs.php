<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserJobs extends Model
{


    public function userJobs()
    {
        return $this->belongsTo('App\Model\Jobs', 'job_id', 'id');
		//return $this->hasOne('App\Model\Jobs', 'id', 'job_id');
    }
    public function Jobs()
    {
        return $this->belongsTo('App\Model\Jobs', 'job_id', 'id');
		//return $this->hasOne('App\Model\Jobs', 'id', 'job_id');
    }
    
	public function Students()
    {
        return $this->hasMany('App\Model\Students', 'job_id', 'job_id');
		//return $this->hasOne('App\Model\Jobs', 'id', 'job_id');
    }

}
