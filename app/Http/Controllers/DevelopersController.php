<?php

namespace App\Http\Controllers;

use App\Contracts\AsDeveloper;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{

    public function index()
    {
        $devs = AsDeveloper::whereHas('applications', function ($query) {
            $query->where('country_code', 'ru');
        })
            ->filter()
            ->orderBy('found_feed_id')
            ->paginate(20);

        $statuses = AsDeveloper::statuses();

        return view('developers.index', compact('devs', 'statuses'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $dev = AsDeveloper::findOrFail($id);

        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $updateArray = [
                'email' => $request->get('email')
            ];
        } else {
            $updateArray = [
                'contact_url' => $request->get('email')
            ];
        }

        $dev->update($updateArray);

        return redirect()->back()
            ->with('success', 'Developer has been successfully updated.');

    }

    public function send($id)
    {

        return redirect()->back()
            ->with('success', 'Developer has been successfully emailed.');
    }

    public function changeStatus($id, $status)
    {
        if (!in_array($status, AsDeveloper::statuses())) {
            abort(404);
        }

        $dev = AsDeveloper::findOrFail($id);
        $dev->status = $status;
        $dev->save();

        return redirect()->back()
            ->with('success', 'Developer has been successfully hidden.');
    }

}
