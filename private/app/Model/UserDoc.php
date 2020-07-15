<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDoc extends Model
{
    protected $fillable = ['user_id', 'filename', 'originalname','global'];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
