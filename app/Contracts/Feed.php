<?php

namespace App\Contracts;

//use Illuminate\Database\Eloquent\Model;

// extends Model
class Feed
{

    public static function nameById($id)
    {
        return (isset(self::$feedNames[$id])) ? self::$feedNames[$id] : '-';
    }

    public static function all()
    {
        return self::$feeds;
    }

    public static $feeds = [
        1 => 'new-apps-we-love',
        2 => 'new-games-we-love',
        3 => 'top-paid',
        4 => 'top-grossing-ipad',
        5 => 'top-grossing',
        6 => 'top-free',
        7 => 'top-free-ipad',
    ];

    public static $feedNames = [
        1 => 'New Apps',
        2 => 'New Games',
        3 => 'Top Paid',
        4 => 'Top Grossing iPad',
        5 => 'Top Grossing',
        6 => 'Top Free',
        7 => 'Top Free iPad',
    ];
}
