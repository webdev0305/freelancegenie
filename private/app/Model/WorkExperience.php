<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experiences';
    protected $fillable = ['organization', 'designation', 'from','to', 'location'];
}
