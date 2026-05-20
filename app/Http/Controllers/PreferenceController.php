<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  

class PreferenceController extends Controller
{
    public function index(Request $request)
    {
        $theme = $request->cookie('theme', 'dark');
        $fontSize = $request->cookie('font_size', '16px');
        return view('preferensi', compact('theme', 'fontSize'));
    }

    public function store(Request $request)
    {
        $theme = $request->input('theme', 'dark');
        $fontSize = $request->input('font_size', '16px');
        $cookieMinutes = 60 * 24 * 365;

        return response()->json(['message' => 'Preferensi disimpan'])
            ->cookie('theme', $theme, $cookieMinutes)
            ->cookie('font_size', $fontSize, $cookieMinutes);
    }
}
