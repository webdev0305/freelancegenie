<?php

namespace App;

use App\Model\Category;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    static function GetUserByMail($email)
    {
        return $userData = static::whereEmail($email)->first();

    }

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'role_users', 'user_id', 'role_id');
    }
	public function subscription()
    {
        return $this->hasOne('App\Model\Subscription');
    }
	public function plan()
    {
        return $this->belongsToMany('App\Model\Plan', 'Subscription', 'user_id', 'plan_id');
    }


    public function Country()
    {
    return $this->belongsToMany('App\Model\Country', 'country_users', 'user_id', 'countries_id');

    }

    public function CountryEmployer()
    {
        return $this->belongsToMany('App\Model\Country', 'employer_profiles', 'user_id', 'country_id');
    }

    public function TutorProfile()
    {
        return $this->hasOne('App\Model\TutorProfile');
    }	public function TeachingCertificates()	{		return $this->hasMany('App\Model\TeachingCertificates','tutor_id');	}
	public function CreditToken()
    {
        return $this->hasMany('App\Model\CreditToken');
    }

//    public function Disciplines()
//    {
//        return $this->belongsToMany('App\Model\Disciplines', 'tutor_profiles', 'user_id', 'discipline_id');
//
//    }

    public function EmployerProfile()
    {
        return $this->hasOne('App\Model\EmployerProfile');
    }

    public function OrganisationsWork()
    {
        return $this->hasMany('App\Model\Organisations');
    }

    public function Categories()
    {
        return $this->belongsToMany('App\Model\Category')->withPivot(['id','qualified_levels_id','rate','disciplines_id','valid']);
    }

    public function QualifiedLevel()
    {
//        return $this->belongsToMany('App\Model\QualifiedLevel');
        return $this->belongsToMany('App\Model\QualifiedLevel', 'category_user', 'user_id', 'qualified_levels_id')->withPivot(['id','category_id']);
    }

    public function Disciplines()
    {
         return $this->belongsToMany('App\Model\Disciplines', 'category_user', 'user_id', 'disciplines_id')->withPivot(['id']);;
    }


    public function parent()
    {
        return $this->belongsTo('App\Model\Category', 'sub_category_id');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Category', 'sub_category_id');
    }

    public function parentLevels()
    {
        return $this->belongsTo('App\Model\QualifiedLevel', 'sub_level_id');
    }

    public function childrenLevels()
    {
        return $this->hasMany('App\Model\QualifiedLevel', 'sub_level_id');
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
