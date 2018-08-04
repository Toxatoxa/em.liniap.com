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
     */
    public function handle()
    {
        $developers = AsDeveloper::with('applications')
            ->whereNull('site')
            ->whereNull('checked_at')
            ->whereHas('applications', function ($query) {
                $query->where('price', '>', 0);
            })
            ->limit(100)
            ->get();

        if (!$developers) {
            return;
        }


        $bar = $this->output->createProgressBar(count($developers));


        foreach ($developers as $developer) {
            $foundSite = false;

            foreach ($developer->applications as $application) {
                $client = new Client();
                $crawler = $client->request('GET', $application->url);
                $a = $crawler->filter('ul.inline-list--app-extensions a')->first();
                if ($a->count()) {
                    $link = (string) trim($a->attr('href'));
                    if ($link) {
                        $developer->site .= ' ' . $link;
                        $developer->save();
                        $foundSite = true;

                        $this->info('Dev #' . $developer->id . ' URL:' . $developer->site);
                    }
                }
            }

            if (!$foundSite) {
                $developer->site = '';
                $developer->save();
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
