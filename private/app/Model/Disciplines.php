<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Disciplines extends Model
{
    protected $table = 'disciplines';
    public $timestamps = false;
     protected $fillable = ['name','sub_disciplines_id'];

    /**
     * {@inheritDoc}
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function parentDisciplines()
    {
        return $this->belongsTo('App\Model\Disciplines','sub_disciplines_id');
    }

    public function childrenDisciplines()
    {
        return $this->hasMany('App\Model\Disciplines','sub_disciplines_id');
    }
}
