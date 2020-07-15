<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobDocs extends Model
{
    protected $fillable = ['job_id', 'filename', 'originalname','logo'];

    public function jobs()
    {
        return $this->belongsTo('App\Model\Jobs');
    }
}
