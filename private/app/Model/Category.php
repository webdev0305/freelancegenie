<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'sub_category_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Model\Category','sub_category_id');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Category', 'sub_category_id');
    }
}
