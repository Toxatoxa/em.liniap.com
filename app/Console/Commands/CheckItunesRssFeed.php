<?php

namespace App\Console\Commands;

use App\Contracts\AsApplication;
use App\Contracts\AsCountry;
use App\Contracts\AsDeveloper;
use App\Contracts\AsGenre;
use App\Contracts\Feed;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class CheckItunesRssFeed extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:itunes_rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check iTunes Rss Feed';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $countries = AsCountry::all();
        $genres = AsGenre::all()->pluck('genre_id')->toArray();

        $feedTypes = Feed::all();

        foreach ($feedTypes as $feedId => $feedString) {
            foreach ($countries as $country) {
                $url = 'https://rss.itunes.apple.com/api/v1/' . $country->code . '/ios-apps/' . $feedString . '/200/explicit.json';

                try {
                    $response = json_decode(file_get_contents($url), true);
                } catch (\Exception $e) {
                    continue;
                }

                if (!$response || !isset($response['feed']['results'])) {
                    continue;
                }

                $appIds = [];

                foreach ($response['feed']['results'] as $result) {
                    $id = $result['id'];
                    if (AsApplication::where('as_id', $id)->first()) {
                        continue;
                    }

                    $developer = null;

                    if (!$developer = AsDeveloper::where('as_id', $result['artistId'])->first()) {
                        $developer = AsDeveloper::create([
                            'as_id'         => $result['artistId'],
                            'name'          => $result['artistName'],
                            'url'           => $result['artistUrl'],
                            'found_feed_id' => $feedId,
                        ]);
                    }

                    $application = $developer->applications()->create([
                        'as_id'         => $id,
                        'name'          => $result['name'],
                        'url'           => $result['url'],
                        'country_code'  => $country->code,
                        'found_feed_id' => $feedId,
                        'release_date'  => $result['releaseDate'],
                    ]);

                    array_push($appIds, $id);

                    if (isset($result['genres']) && $result['genres']) {
                        $appGenres = [];
                        foreach ($result['genres'] as $genre) {
                            $appGenres[] = $genre['genreId'];
                            if (!in_array($genre['genreId'], $genres)) {
                                AsGenre::create([
                                    'genre_id' => $genre['genreId'],
                                    'name'     => $genre['name'],
                                    'url'      => $genre['url'],
                                ]);
                            }
                        }
                        $application->genres()->attach($appGenres);
                    }
                }

                self::updateAppsPrice($appIds);
                sleep(2);
            }

            //

        }
    }

    public static function updateAppsPrice($ids)
    {
        $ids = implode(",", $ids);

        $client = new Client();

        $res = $client->get('https://itunes.apple.com/lookup?id=' . $ids);

        $responseArray = json_decode($res->getBody(), true);

        foreach ($responseArray['results'] as $result) {

            $app = AsApplication::where('as_id', $result['trackId'])->first();
            $app->price = $result['price'];
            $app->save();
        }
    }
}
