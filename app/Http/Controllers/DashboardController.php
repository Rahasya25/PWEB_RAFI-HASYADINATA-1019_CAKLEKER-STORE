<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataStatistik = [
            (object) ['judul' => 'Total Produk', 'nilai' => 24, 'ikon' => '📦', 'warna' => '#DC0000'],
            (object) ['judul' => 'Total Stok', 'nilai' => 342, 'ikon' => '📊', 'warna' => '#FFD700'],
            (object) ['judul' => 'Kategori', 'nilai' => 5, 'ikon' => '🏷️', 'warna' => '#4CAF50'],
            (object) ['judul' => 'Pendapatan', 'nilai' => '125 Jt', 'ikon' => '💰', 'warna' => '#2196F3'],
        ];
        return view('dashboard', compact('dataStatistik'));
    }
}
