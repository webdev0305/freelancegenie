<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    protected $table = 'employer_profiles';

    /**
     * {@inheritDoc}
     */


    public function user(){

        return $this->belongsTo('App\User');

    }
	
}
