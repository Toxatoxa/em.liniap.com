<?php

namespace App\Listeners;

use App\Events\EmailInfoUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateEmailInfo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailInfoUpdate  $event
     * @return void
     */
    public function handle(EmailInfoUpdate $event)
    {
        //
    }
}
