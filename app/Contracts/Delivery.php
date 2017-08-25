<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from_email',
        'from_name',
        'subject',
        'body',
    ];

    protected $dates = ['sent_at', 'deleted_at'];

    public function emails()
    {
        return $this->hasMany(DeliveryEmail::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
