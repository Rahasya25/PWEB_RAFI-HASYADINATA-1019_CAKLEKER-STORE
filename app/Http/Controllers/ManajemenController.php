<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->has('visit_count')) {
            $session->put('visit_count', 1);
            $session->put('first_visit', now());
            $session->put('last_visit', now());
        } else {
            $session->increment('visit_count');
            $session->put('last_visit', now());
        }
        return view('manajemen', [
            'visit_count' => $session->get('visit_count'),
            'first_visit' => $session->get('first_visit'),
            'last_visit'  => $session->get('last_visit'),
        ]);
    }

    public function reset()
    {
        session()->forget(['visit_count', 'first_visit', 'last_visit']);
        return response()->json(['message' => 'Hitungan telah direset']);
    }
}
