<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class AsApplication extends Model
{

    protected $fillable = [
        'as_id',
        'name',
        'url',
        'country_code',
        'price',
        'found_feed_id',
        'release_date',
    ];

    public function genres()
    {
        return $this->belongsToMany(AsGenre::class, 'as_application_genre');
    }

}
