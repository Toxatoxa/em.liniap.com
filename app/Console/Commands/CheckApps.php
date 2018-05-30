<?php

namespace App\Console\Commands;

use App\Contracts\AsApplication;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class CheckApps extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:apps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Apps';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        for ($i = 1; $i < 20; $i++) {
            $apps = AsApplication::whereNull('price')
                ->where('id', '>', 2070)
                ->limit(100)
                ->pluck('as_id')
                ->toArray();

            $ids = implode(",", $apps);

            echo $ids . "\n\n";

            $client = new Client();

            $res = $client->get('https://itunes.apple.com/lookup?id=' . $ids);

            $responseArray = json_decode($res->getBody(), true);

            foreach ($responseArray['results'] as $result) {

                $app = AsApplication::where('as_id', $result['trackId'])->first();
                $app->price = $result['price'];
                $app->save();
            }

            sleep(5);
        }

    }
}
