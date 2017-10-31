<?php

namespace App\Http\Controllers;

use App\Contracts\Template;
use Illuminate\Http\Request;

class TemplatesController extends Controller
{

    public function index()
    {
        $templates = Template::all();

        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:190',
            'subject'       => 'required|max:190',
            'body'          => 'required',
            'language_code' => 'required',
        ]);

        $template = Template::create($request->all());

        return redirect(route('templates.show', $template->id))
            ->with('success', 'Template has been successfully added.');
    }

    public function show($id)
    {
        $template = Template::findOrFail($id);

        return view('templates.show', compact('template'));
    }

    public function edit($id)
    {
        $template = Template::findOrFail($id);

        return view('templates.edit', compact('template'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:190',
            'subject'       => 'required|max:190',
            'body'          => 'required',
            'language_code' => 'required',
        ]);

        $template = Template::findOrFail($id);

        $template->update($request->all());

        return redirect(route('templates.show', $template->id))
            ->with('success', 'Template has been successfully updated.');

    }

    public function destroy($id)
    {
        $template = Template::findOrFail($id);

        $template->delete();

        return redirect(route('templates.index'))
            ->with('success', 'Template has been successfully deleted.');
    }
}
