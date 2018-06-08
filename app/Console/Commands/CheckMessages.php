<?php

namespace App\Console\Commands;

use App\Contracts\Message;
use App\Mail\EmailToAnton;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use VK\Client\VKApiClient;

class CheckMessages extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Messages';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $vk = new VKApiClient();
        $response = $vk->messages()->getHistory(env('VK_TOKEN'), array(
            'count'   => 50,
            'user_id' => env('VK_USER_ID'),
        ));

        if (!$response['count']) {
            return;
        }

        $messageIds = Message::all()->pluck('vk_id')->toArray();
        $lastMessage = Message::orderBy('id', 'DESC')->limit(1)->first();

        $i = 0;
        foreach ($response['items'] as $items) {
            if (!in_array($items['id'], $messageIds)) {
                Message::create([
                    'vk_id'   => $items['id'],
                    'user_id' => $items['user_id'],
                    'from_id' => $items['from_id'],
                    'body'    => $items['body'],
                ]);

                if (!$i && $lastMessage->created_at <= Carbon::now()->subHour()) {
                    Mail::to('anton.antonov@sidekick-content.com')->send(new EmailToAnton());
                }
                $i++;
            }
        }
    }
}
