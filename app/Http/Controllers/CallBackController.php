<?php

namespace App\Http\Controllers;

use App\Contracts\CallbackLog;
use App\Events\EmailInfoUpdate;
use Illuminate\Http\Request;

class CallBackController extends Controller
{

    public function action($action, Request $request)
    {
        $callback = CallbackLog::create([
            'delivery_emails_id' => 0,
            'action'             => $action,
            'body'               => $request->all(),
        ]);

        $callback->delivery_emails_id = (isset($callback->body['email_id'])) ? $callback->body['email_id'] : 0;
        $callback->save();
        // Test
//        $callback = CallbackLog::find(11);
//        $email = DeliveryEmail::find(12);

        if ($callback->email) {
            switch ($callback->action) {
                case 'delivered':
                    $callback->email->received_at = carbon()->now();
                    break;
                case 'opened':
                    $callback->email->opened_at = carbon()->now();
                    break;
                case 'clicked':
                    $callback->email->clicked_at = carbon()->now();
                    break;
                default :
                    $callback->email->error_at = carbon()->now();
            }

            $callback->email->save();
            event(new EmailInfoUpdate($callback->email));
        }

        return [];
    }
}
