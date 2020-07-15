<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QualifiedLevel extends Model
{
    public $timestamps = false;

    protected $table = 'qualified_levels';
    protected $fillable = ['level','sub_level_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function parentLevels()
    {
        return $this->belongsTo('App\Model\QualifiedLevel','sub_level_id');
    }

    public function childrenLevels()
    {
        return $this->hasMany('App\Model\QualifiedLevel','sub_level_id');
    }
}
