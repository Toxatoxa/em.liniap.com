<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsDeveloper extends Model
{

    use SoftDeletes;

    const STATUS_NO_CONTACTS = 'no_contacts';
    const STATUS_CANNOT_FIND_CONTACTS = 'can_not_find_contacts';
    const STATUS_HAS_CONTACTS = 'has_contacts';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_RECEIVED_EMAIL = 'received_email';
    const STATUS_SIGNED_UP = 'signed_up';


    protected $fillable = [
        'as_id',
        'name',
        'contact_persona',
        'site',
        'language_code',
        'url',
        'email',
        'contact_url',
        'found_feed_id',
        'checked_at',
    ];

    protected $dates = [
        'created_at',
        'checked_at',
        'contacted_at',
        'received_at',
        'signed_at',
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
        if (request()->get('search')) {
            $query->where('name', 'like', '%' . request()->get('search') . '%')
                ->orWhere('email', 'like', '%' . request()->get('search') . '%')
                ->orWhere('site', 'like', '%' . request()->get('search') . '%');
        }

        if (request()->get('paid')) {
            $query->whereHas('applications', function ($query) {
                $query->whereNotNull('price');
                $query->where('price', '>', 0);
            });
        }

        if (request()->get('language_code')) {
            $query->where('language_code', request()->get('language_code'));
        }

        if (request()->get('status')) {
            $status = request()->get('status');

            if ($status == self::STATUS_NO_CONTACTS) {
                $query->whereNull('checked_at');
            } elseif ($status == self::STATUS_CANNOT_FIND_CONTACTS) {
                $query->whereNotNull('checked_at')
                    ->whereNull('email')
                    ->whereNull('contact_url');
            } elseif ($status == self::STATUS_HAS_CONTACTS) {
                $query->whereNotNull('checked_at')
                    ->where(function ($q) {
                        $q->whereNotNull('email')
                            ->orWhereNotNull('contact_url');
                    })
                    ->whereNull('contacted_at');
            } elseif ($status == self::STATUS_CONTACTED) {
                $query->whereNotNull('contacted_at');
            } elseif ($status == self::STATUS_RECEIVED_EMAIL) {
                $query->whereNotNull('received_at')
                    ->whereNull('signed_at');
            } elseif ($status == self::STATUS_SIGNED_UP) {
                $query->whereNotNull('signed_at');
            }
        }

        return $query;
    }

    public function getFoundFeedAttribute()
    {
        return Feed::nameById($this->found_feed_id);
    }

    public function getContactNameAttribute()
    {
        return ($this->contact_persona) ? $this->contact_persona : 'команда проекта ' . $this->name;
    }


    public static function allStatuses()
    {
        return [
            self::STATUS_NO_CONTACTS,
            self::STATUS_CANNOT_FIND_CONTACTS,
            self::STATUS_HAS_CONTACTS,
            self::STATUS_CONTACTED,
            self::STATUS_RECEIVED_EMAIL,
            self::STATUS_SIGNED_UP,
        ];
    }

    public static function contactStatuses()
    {
        return [
            self::STATUS_NO_CONTACTS,
            self::STATUS_CANNOT_FIND_CONTACTS,
            self::STATUS_HAS_CONTACTS,
            self::STATUS_CONTACTED,
        ];
    }

    public static function emailStatuses()
    {
        return [
            self::STATUS_RECEIVED_EMAIL,
            self::STATUS_SIGNED_UP,
        ];
    }
}
