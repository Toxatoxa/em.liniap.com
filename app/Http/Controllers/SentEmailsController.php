<?php

namespace App\Http\Controllers;

use App\Contracts\DeliveryEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SentEmailsController extends Controller
{

    public function index()
    {
        $emails = DeliveryEmail::with('delivery')
            ->orderBy('id', 'desc')
            ->paginate(50);

        $stat = DB::table('delivery_emails')->select(DB::raw('count(id) as count_all,
                sum(if(sent_at is null, 0, 1)) as count_sent,
                sum(if(received_at is null, 0, 1)) as count_received,
                sum(if(opened_at is null, 0, 1)) as count_opened,
                sum(if(clicked_at is null, 0, 1)) as count_clicked,
                sum(if(error_at is not null || dropped_at is not null || bounced_at is not null || complained_at is not null || unsubscribed_at is not null, 1, 0)) as count_errors
            '))
            ->first();

        return view('sent_emails.index', compact('emails', 'stat'));
    }
}
