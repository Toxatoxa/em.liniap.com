<?php

namespace App\Mail;

use App\Contracts\DeliveryEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailToClient extends Mailable
{

    use Queueable, SerializesModels;

    protected $deliveryEmail;
    protected $markAsDone;

    /**
     * EmailToClient constructor.
     * @param DeliveryEmail $deliveryEmail
     * @param bool $markAsDone
     */
    public function __construct(DeliveryEmail $deliveryEmail, $markAsDone = false)
    {
        $this->deliveryEmail = $deliveryEmail;
        $this->markAsDone = $markAsDone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $delivery = $this->deliveryEmail->delivery;

        $this->deliveryEmail->sent_at = Carbon::now();
        $this->deliveryEmail->save();

        if ($this->markAsDone) {
            $delivery->sent_at = Carbon::now();
            $delivery->save();
        }

        return $this
            ->from($delivery->account->email, $delivery->account->name)
            ->subject($delivery->subject)
            ->withSwiftMessage(function ($message) {
                $headers = $message->getHeaders();
                $headers->addTextHeader('X-Mailgun-Variables', '{"email_id": ' . $this->deliveryEmail->id . '}');
            })
            ->view('emails.empty', ['data' => $delivery->body]);
    }
}