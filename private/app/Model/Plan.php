<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plan';
	 public function subscription()
    {
       // return $this->hasMany('App\Model\Subscription','plan_id','id');
        return $this->hasMany('App\Model\Subscription');
    }
}
