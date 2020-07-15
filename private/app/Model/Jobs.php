<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
   public function Tutor()
    {
        return $this->hasOne('App\User','id','tutor_id');
    }
	public function Students()
    {
        return $this->hasMany('App\Model\Students','job_id','id');
    }
    public function JobDocs()
    {
        return $this->hasMany('App\Model\JobDocs','job_id','id');
    }

    public function Employer()
    {
        return $this->hasOne('App\User','id','employer_id');
    }
    public function EmployerProfile()
    {
        return $this->belongsTo('App\Model\EmployerProfile','employer_id','user_id');
    }

    public function Categories()
    {
       //return $this->hasOne('App\Model\Category','id','category_id');
      return $this->belongsToMany('App\Model\Category','category_user', 'category_id', 'id');

    }

    public function QualifiedLevels()
    {
        return $this->hasOne('App\Model\QualifiedLevel','id','qualified_levels_id');
    }

    public function Disciplines()
    {
//        return $this->belongsToMany('App\Model\Disciplines','discipline_users', 'user_id', 'disciplines_id');
         return $this->hasOne('App\Model\Disciplines','id','sub_disciplines_id');

    }

    public function userJobs()
    {
        return $this->belongsToMany('App\User','user_jobs', 'job_id', 'user_id')->withPivot(['status'])->withTimestamps();
    }

    public function userJobsMeta()
    {
        return $this->belongsToMany('App\Model\TutorProfile','user_jobs', 'job_id', 'user_id')->withPivot(['status']);
    }
	public function Rating()
    {
        return $this->hasOne('App\Rating','job_id','id');
     }
	 public function Invoice()
		{
			return $this->hasMany('App\Model\Invoice','booking_no','id');
		}
		
}
