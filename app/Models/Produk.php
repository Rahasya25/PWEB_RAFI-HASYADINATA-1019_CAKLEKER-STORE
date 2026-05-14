<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'stok_produk',
        'harga_produk',
        'tanggal_masuk',
        'foto_produk',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'stok_produk'   => 'integer',
        'harga_produk'  => 'integer',
    ];
}
