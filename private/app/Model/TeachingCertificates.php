<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeachingCertificates extends Model
{
    protected $fillable = ['tutor_id', 'filename', 'originalname', 'type'];
	public function User()

    {

     return $this->belongsTo('App\User');

    }
}
