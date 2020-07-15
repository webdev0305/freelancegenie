<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    public function Jobs()
    {
        return $this->belongsTo('App\Model\Jobs','job_id','id');
    }
}
