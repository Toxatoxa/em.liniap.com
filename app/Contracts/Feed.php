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
        3 => 'top-free',
        4 => 'top-free-ipad',
        5 => 'top-grossing',
        6 => 'top-grossing-ipad',
        7 => 'top-paid',
    ];

    public static $feedNames = [
        1 => 'New Apps',
        2 => 'New Games',
        3 => 'Top Free',
        4 => 'Top Free iPad',
        5 => 'Top Grossing',
        6 => 'Top Grossing iPad',
        7 => 'Top Paid',
    ];
}
