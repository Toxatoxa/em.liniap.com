<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'vk_id',
        'user_id',
        'from_id',
        'body'
    ];
}
