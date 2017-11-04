<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

class AsDeveloper extends Model
{

    const STATUS_NEW = 'new';
    const STATUS_EMAILED = 'emailed';
    const STATUS_HIDDEN = 'hidden';
    const STATUS_EN = 'en';


    protected $fillable = [
        'as_id',
        'name',
        'url',
        'email',
        'site',
        'found_feed_id',
        'contact_url',
    ];

    public function applications()
    {
        return $this->hasMany(AsApplication::class, 'developer_id');
    }

    /**
     * @param $query
     * @return $query
     */
    public function scopeFilter($query)
    {
        $status = request()->get('status', self::STATUS_NEW);

        $query->where('status', $status);

        if (request()->get('needs_email')) {
            $query->whereNotNull('site')
                ->whereNull('email')
                ->whereNull('contact_url');
        }

        return $query;
    }

    public function getFoundFeedAttribute()
    {
        return Feed::nameById($this->found_feed_id);
    }

    public static function statuses()
    {
        return [
            self::STATUS_NEW,
            self::STATUS_EMAILED,
            self::STATUS_HIDDEN,
            self::STATUS_EN,
        ];
    }
}
