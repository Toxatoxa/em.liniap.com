<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function image(Request $request)
    {
        $image = $request->file('image');
        $filename = str_random(10) . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/uploads'), $filename);

        return (response()->json(['location' => asset('img/uploads/' . $filename)]));
    }
}
