<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryUser extends Model
{
    protected $table = 'category_user';
    protected $fillable = ['user_id', 'category_id', 'qualified_levels_id'];
    protected $guarded = array('id');

    public function Categories()
    {
         return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

    public function QualifiedLevel()
    {
        return $this->hasOne('App\Model\QualifiedLevel', 'id', 'qualified_levels_id');
    }

    public function Disciplines()
    {
        return $this->hasOne('App\Model\Disciplines', 'id', 'disciplines_id');
    }

}
