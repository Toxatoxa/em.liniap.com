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
        1 => 'new-apps-we-love/all',
        2 => 'top-free/all',
        3 => 'top-free/games',
        4 => 'top-free-ipad/all',
        5 => 'top-grossing/all',
        6 => 'top-grossing-ipad',
        7 => 'top-paid/all',
        8 => 'top-paid/games',
    ];

    /*
     * https://rss.itunes.apple.com/api/v1/us/ios-apps/new-apps-we-love/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-free/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-free/games/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-free-ipad/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-grossing/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-grossing-ipad/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-paid/all/10/explicit.json
     * https://rss.itunes.apple.com/api/v1/ru/ios-apps/top-paid/games/10/explicit.json
     */

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
