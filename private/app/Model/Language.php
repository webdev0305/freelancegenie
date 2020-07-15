<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    /**
     * {@inheritDoc}
     */
    protected $fillable = array(
        'name',
    );
}
