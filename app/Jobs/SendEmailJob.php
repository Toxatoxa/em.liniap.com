<?php

namespace App\Jobs;

use App\Contracts\DeliveryEmail;
use App\Mail\EmailToClient;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email_id;
    protected $isLast;

    /**
     * SendEmailJob constructor.
     * @param $email_id
     * @param bool $isLast
     */
    public function __construct($email_id, $isLast = false)
    {
        $this->email_id = $email_id;
        $this->isLast = $isLast;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = DeliveryEmail::with('delivery.account')->find($this->email_id);
        if (!$email || !filter_var($email->recipient_email, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        Mail::to($email->recipient_email)->send(new EmailToClient($email));
    }
}
