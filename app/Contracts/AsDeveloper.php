<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class AsDeveloper extends Model
{

    protected $fillable = [
        'as_id',
        'name',
        'url',
        'email',
        'site',
    ];

    public function applications()
    {
        return $this->hasMany(AsApplication::class, 'developer_id');
    }
}
