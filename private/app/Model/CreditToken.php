<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditToken extends Model
{

	protected $table = 'credit_tokens';
	protected $fillable = [
        'user_id',
        'token_year'
		'token',
		'tutor_id'
        // add all other fields
    ];
   /* public function creditToken()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }*/
	public function User()
    {
     return $this->belongsTo('App\User');
    }
	

}
