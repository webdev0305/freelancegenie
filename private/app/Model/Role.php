<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'roles';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'slug',
        'name',
        'permissions',

    );


}
