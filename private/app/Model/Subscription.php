<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscription';
	public function plan()
    {
        //return $this->belongsTo('App\Model\Plan','plan_id','id');
        return $this->belongsTo('App\Model\Plan');
    }
    public function SubscriptionLimit()
    {
        return $this->hasMany('App\Model\SubscriptionLimit');
    }

}
