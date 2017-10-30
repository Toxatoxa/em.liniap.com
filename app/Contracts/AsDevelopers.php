<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class AsDevelopers extends Model
{

    protected $fillable = [
        'as_id',
        'name',
        'url',
    ];

    public function applications()
    {
        return $this->hasMany(AsApplication::class, 'developer_id');
    }
}
