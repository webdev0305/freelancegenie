<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Organisations extends Model
{
    protected $table = 'organisations';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'company_name',
        'registration',
     );
}
