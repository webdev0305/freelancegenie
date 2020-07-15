<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
    protected $table = 'tutor_profiles';
    protected $primaryKey = 'user_id';
    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'user_id',
        'address',
        'city',
        'state',
        'country_id',
        'language_id',
        'skill_id',
        'specialization_id',
        'discipline_id',
        'course_id',
        'certification_id',
        'about',
        'resume',
		'dbs_organisation'
    );

    public function User()
    {
     return $this->belongsTo('App\User');
    }

    public function Categories()
    {
          return $this->belongsToMany('App\Model\Category', 'category_user', 'user_id', 'category_id');
    }

    public function QualifiedLevel()
    {
         return $this->belongsToMany('App\Model\QualifiedLevel', 'category_user', 'user_id', 'qualified_levels_id');
    }

    public function Disciplines()
    {
         return $this->belongsToMany('App\Model\Disciplines','category_user', 'user_id', 'disciplines_id');
    }

    public function Country()
    {
        return $this->belongsToMany('App\Model\Country', 'country_users', 'user_id', 'countries_id');

     }
	 public function Rating()
    {
        return $this->hasMany('App\Rating');

     }	 
}
