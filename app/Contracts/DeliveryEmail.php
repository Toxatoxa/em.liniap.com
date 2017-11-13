<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryEmail extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'template_id',
        'recipient_email',
        'sent_at',
    ];

    protected $dates = ['sent_at', 'deleted_at'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

}
