<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function Jobs()
		{
			return $this->belongsTo('App\Model\Jobs','booking_no','id');
		}
}
