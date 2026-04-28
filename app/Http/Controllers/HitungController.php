<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function index(Request $request)
    {
        $hasil = null;
        if ($request->has('a') && $request->has('b')) {
            $a = $request->input('a');
            $b = $request->input('b');
            $hasil = $a + $b;
        }
        return view('hitung', compact('hasil'));
    }
}
