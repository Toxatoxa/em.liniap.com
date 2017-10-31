<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    protected $fillable = [
        'name', 'subject', 'body', 'language_code',
    ];
}
