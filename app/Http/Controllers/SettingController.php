<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class SettingController extends Controller
{
    public function show(string $slug)
    {
        $info = Setting::where('key', $slug)->first();

        if (! $info) {
            return redirect()->back()->with('error', 'No information found!');
        }

        return view('user.info', compact('info'));
    }
}
