<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class AsGenre extends Model
{

    protected $fillable = [
        'genre_id',
        'name',
        'url',
    ];

    public function applications()
    {
        return $this->belongsToMany(AsApplication::class)->withTimestamps();
    }
}
