<?php

namespace App\Http\Controllers;

use App\Contracts\AsDeveloper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{

    public function index()
    {
        $devs = AsDeveloper::filter()
            ->orderBy('found_feed_id')
            ->paginate(20);

        $statuses = AsDeveloper::allStatuses();

        return view('developers.index', compact('devs', 'statuses'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name'          => 'required',
            'language_code' => 'required',
            'email'         => 'email|nullable',
        ]);

        $attributes = request()->all();
        AsDeveloper::create($attributes);

        return redirect(route('developers.index'))
            ->with('success', 'Developer has been successfully created.');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'language_code' => 'required',
            'email'         => 'email|nullable',
        ]);

        $dev = AsDeveloper::findOrFail($id);

        $dev->update([
            'name'            => $request->get('name'),
            'contact_persona' => $request->get('contact_persona'),
            'site'            => $request->get('site'),
            'language_code'   => $request->get('language_code'),
            'email'           => $request->get('email'),
            'contact_url'     => $request->get('contact_url'),
            'checked_at'      => ($request->get('next')) ? Carbon::now() : null,
        ]);

        return redirect()->back()
            ->with('success', 'Developer has been successfully updated.');

    }

    public function edit($id)
    {
        $dev = AsDeveloper::findOrFail($id);
        $edit = true;

        return view('developers.find_contacts', compact('dev', 'edit'));
    }

    public function findContacts()
    {
        $dev = AsDeveloper::whereHas('applications', function ($query) {
            $query->where('country_code', 'ru');
        })
            ->whereNotNull('site')
            ->whereNull('checked_at')
            ->orderBy('found_feed_id')
            ->first();

        if (!$dev) {
            return redirect('developers')
                ->with('success', 'Developer has been successfully hidden.');
        }

        $edit = false;

        return view('developers.find_contacts', compact('dev', 'edit'));
    }

    public function setContacted($id)
    {
        $dev = AsDeveloper::findOrFail($id);

        if (!$dev->email && !$dev->contact_url) {
            abort(404, 'Developer does not have contact info');
        }

        $dev->checked_at = $dev->contacted_at = Carbon::now();
        $dev->save();

        return redirect()->back()
            ->with('success', 'Developer has been successfully updated.');
    }

    public function setSignedUp($id)
    {
        $dev = AsDeveloper::findOrFail($id);

        if (!$dev->contacted_at) {
            abort(404, 'Developer has not been contacted');
        }

        $dev->signed_at = Carbon::now();
        $dev->save();

        return redirect()->back()
            ->with('success', 'Developer has been successfully updated.');
    }

    public function delete($id)
    {
        $dev = AsDeveloper::findOrFail($id);
        $dev->delete();

        return redirect()->back()
            ->with('success', 'Developer has been successfully deleted.');
    }

}
