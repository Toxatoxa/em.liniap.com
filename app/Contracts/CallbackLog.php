<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class CallbackLog extends Model
{

    protected $fillable = [
        'delivery_emails_id',
        'action',
        'body',
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected $casts = [
        'body' => 'array',
    ];

    public function email()
    {
        return $this->belongsTo(DeliveryEmail::class, 'delivery_emails_id');
    }
}
