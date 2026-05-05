<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $table = 'merchandises';
    protected $fillable = ['kode_produk', 'nama_produk', 'kategori', 'stok', 'harga', 'tanggal_masuk', 'foto'];
    protected $casts = [
        'tanggal_masuk' => 'date',
        'stok' => 'integer',
        'harga' => 'integer',
    ];
    public function scopeAktif($query)
    {
        return $query->where('stok', '>', 0);
    }
}
