<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'name',
        'alias'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }

    public function getEmailAttribute()
    {
        return $this->alias . '@' . $this->domain;
    }

    public function getDomainAttribute()
    {
        return env('MAILGUN_DOMAIN');
    }


}
