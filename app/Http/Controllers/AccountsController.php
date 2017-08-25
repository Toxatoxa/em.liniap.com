<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{

    public function index()
    {
        $accounts = user()->accounts;

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:190',
            'alias' => 'required|max:190'
        ]);

        $account = user()->accounts()->create($request->all());

        return redirect(route('accounts.show', $account->id))
            ->with('success', 'Account has been successfully added.');
    }

    public function show($id)
    {
        $account = user()->accounts()->findOrFail($id);

        return view('accounts.show', compact('account'));
    }

    public function edit($id)
    {
        $account = user()->accounts()->findOrFail($id);

        return view('accounts.edit', compact('account'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:190',
            'alias' => 'required|max:190'
        ]);

        $account = user()->accounts()->findOrFail($id);

        $account->update($request->all());

        return redirect(route('accounts.show', $account->id))
            ->with('success', 'Account has been successfully updated.');

    }

    public function destroy($id)
    {
        $account = user()->accounts()->findOrFail($id);

        $account->delete();

        return redirect(route('accounts.index'))
            ->with('success', 'Account has been successfully deleted.');
    }
}
