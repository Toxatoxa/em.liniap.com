<?php

namespace App\Console\Commands;

use App\Contracts\AsDeveloper;
use Illuminate\Console\Command;
use Goutte\Client;

class GetDeveloperWebSite extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:dev_site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Developer Web Site';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $developer = AsDeveloper::with('applications')->whereNull('site')->first();

        foreach ($developer->applications as $application) {
            $client = new Client();
            $crawler = $client->request('GET', $application->url);

            $a = $crawler->filter('.app-links a')->first();
            if ($a->count()) {
                $link = (string) trim($a->attr('href'));
                if ($link) {
                    $developer->site = $link;
                    $developer->save();
                    break;
                }
            }

        }

        if ($developer->site === null) {
            $developer->site = '';
            $developer->save();
        }
    }
}
