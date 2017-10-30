<?php

namespace App\Console\Commands;

use App\Contracts\AsApplication;
use App\Contracts\AsCountry;
use App\Contracts\AsDeveloper;
use App\Contracts\AsGenre;
use Illuminate\Console\Command;

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
     * @return mixed
     */
    public function handle()
    {
        $countries = AsCountry::all();
        $genres = AsGenre::all()->pluck('genre_id')->toArray();

        foreach ($countries as $country) {
            $url = 'https://rss.itunes.apple.com/api/v1/' . $country->code . '/ios-apps/new-apps-we-love/all/200/explicit.json';
            $response = json_decode(file_get_contents($url), true);

            if (!$response || !isset($response['feed']['results'])) {
                continue;
            }

            foreach ($response['feed']['results'] as $result) {
                $id = $result['id'];
                if (AsApplication::where('as_id', $id)->first()) {
                    continue;
                }

                if (!$developer = AsDeveloper::where('as_id', $result['artistId'])->first()) {
                    $developer = AsDeveloper::create([
                        'as_id' => $result['artistId'],
                        'name'  => $result['artistName'],
                        'url'   => $result['artistUrl'],
                    ]);
                }

                $application = $developer->applications()->create([
                    'as_id'        => $id,
                    'name'         => $result['name'],
                    'url'          => $result['url'],
                    'country_code' => $country->code,
                    'release_date' => $result['releaseDate'],
                ]);

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
        }
    }
}