<?php

namespace App\Http\Controllers;

use App\Contracts\AsDeveloper;
use App\Contracts\Delivery;
use App\Contracts\DeliveryEmail;
use App\Contracts\Template;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{

    public function index()
    {
        $deliveries = Delivery::with('account', 'emails')
            ->orderBy('id', 'desc')
            ->paginate(50);

        return view('delivery.index', compact('deliveries'));
    }

    public function create(Request $request)
    {
        $delivery = ($request->get('copy_id')) ? Delivery::findOrFail($request->get('copy_id')) : new Delivery();
        $accounts = user()->accounts;
        $recipients = [];
        $developer = null;


        if ($request->get('developer_id')) {
            $developer = AsDeveloper::find($request->get('developer_id'));
            if ($developer) {
                $recipients[] = $developer->email;
            }
        }

        if ($request->get('template_id')) {
            $template = Template::find($request->get('template_id'));
            if ($template) {
                $delivery->subject = $template->subject;
                if ($developer) {
                    $delivery->body = str_replace('{name}', $developer->contact_name, $template->body);
                } else {
                    $delivery->body = $template->body;
                }
            }
        }

        return view('delivery.create', compact('delivery', 'accounts', 'recipients'));
    }

    public function show(Delivery $delivery)
    {
        $stat = DB::table('delivery_emails')->select(DB::raw('count(id) as count_all,
                sum(if(sent_at is null, 0, 1)) as count_sent,
                sum(if(received_at is null, 0, 1)) as count_received,
                sum(if(opened_at is null, 0, 1)) as count_opened,
                sum(if(clicked_at is null, 0, 1)) as count_clicked,
                sum(if(error_at is not null || dropped_at is not null || bounced_at is not null || complained_at is not null || unsubscribed_at is not null, 1, 0)) as count_errors
            '))
            ->where('delivery_id', $delivery->id)
            ->first();

        return view('delivery.show', compact('delivery', 'stat'));
    }

    public function resend($id)
    {
        $emails = DeliveryEmail::where('delivery_id', $id)
            ->whereNull('sent_at')
            ->get();
        foreach ($emails as $email) {
            dispatch(new SendEmailJob($email->id));
        }


        return redirect()->back();
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required|max:190',
            'recipients' => 'required',
            'subject'    => 'required|max:190',
            'body'       => 'required',
        ]);

        $account = user()->accounts()->findOrFail($request->get('account_id'));
        $delivery = $account->delivery()->create($request->all());

        if ($delivery) {
            $recipients = explode(',', $request->get('recipients'));
            foreach ($recipients as $recipient) {
                $email = $delivery->emails()->create([
                    'recipient_email' => $recipient
                ]);
                dispatch(new SendEmailJob($email->id));
            }
        }

        return redirect(route('delivery.show', $delivery->id))
            ->with('undo', $delivery->id);
    }

    public function undo($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery && !$delivery->sent_at) {
            $delivery->delete();
        }

        return redirect(route('delivery.index'));
    }

    public function errors($id)
    {
        $delivery = Delivery::with(['emails' => function ($query) {
            $query->whereNotNull('error_at');
        }])->findOrFail($id);

//        Email::where('delivery_id', $id)
//            ->whereNotNull('error_at')
//            ->get();

//        dd($delivery);

        return view('delivery.errors', compact('delivery'));
    }
}
