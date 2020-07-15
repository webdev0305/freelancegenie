<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /*public $timestamps = false;

    protected $table = 'ratings';
	//protected $primaryKey = 'user_id';
    protected $fillable = ['employer_id','objectives'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }*/
	public function TutorProfile()
    {
        return $this->belongsToMany('App\Model\TutorProfile');
    }
	public function Jobs()
    {
        return $this->belongsTo('App\Model\Jobs');
    }
}
