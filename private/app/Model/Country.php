<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'name',
    );

    public function parent()
    {
        return $this->belongsTo('App\Model\Country','sub_country_id');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Country', 'sub_country_id');
    }
//    public function TutorProfile()
//    {
//        return $this->hasOne('App\Model\TutorProfile');
//    }
}
