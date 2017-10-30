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
        })->get();

        return view('developers.index', compact('devs'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $dev = AsDeveloper::findOrFail($id);

        $dev->update($request->all());

        return redirect(route('developers.index'))
            ->with('success', 'Developer has been successfully updated.');

    }

    public function send($id)
    {

        return redirect(route('developers.index'))
            ->with('success', 'Developer has been successfully emailed.');
    }

}
