<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchandise;

class MerchandiseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_produk' => 'F001',
                'nama_produk' => 'Race Suit SF-24',
                'kategori'    => 'Race Wear',
                'stok'        => 8,
                'harga'       => 3750000,
                'tanggal_masuk' => '2025-01-10',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F002',
                'nama_produk' => 'Ferrari Heritage Cap',
                'kategori'    => 'Aksesoris',
                'stok'        => 45,
                'harga'       => 475000,
                'tanggal_masuk' => '2025-01-15',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F003',
                'nama_produk' => 'Diecast SF90 Stradale 1:18',
                'kategori'    => 'Diecast',
                'stok'        => 6,
                'harga'       => 1350000,
                'tanggal_masuk' => '2025-02-01',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F004',
                'nama_produk' => 'Team Jersey Scuderia Ferrari',
                'kategori'    => 'Daily Wear',
                'stok'        => 22,
                'harga'       => 895000,
                'tanggal_masuk' => '2025-02-10',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F005',
                'nama_produk' => 'Carbon Fiber Keychain',
                'kategori'    => 'Aksesoris',
                'stok'        => 110,
                'harga'       => 145000,
                'tanggal_masuk' => '2025-03-01',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F006',
                'nama_produk' => 'Leclerc #16 Mini Helmet',
                'kategori'    => 'Limited Edition',
                'stok'        => 4,
                'harga'       => 2450000,
                'tanggal_masuk' => '2025-03-15',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F007',
                'nama_produk' => 'Ferrari Sweater Hoodie',
                'kategori'    => 'Daily Wear',
                'stok'        => 15,
                'harga'       => 1250000,
                'tanggal_masuk' => '2025-03-20',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F008',
                'nama_produk' => 'Mug Scuderia Ferrari',
                'kategori'    => 'Aksesoris',
                'stok'        => 75,
                'harga'       => 189000,
                'tanggal_masuk' => '2025-04-01',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F009',
                'nama_produk' => 'SF-24 Polo Shirt',
                'kategori'    => 'Race Wear',
                'stok'        => 12,
                'harga'       => 625000,
                'tanggal_masuk' => '2025-04-10',
                'foto'        => null,
            ],
            [
                'kode_produk' => 'F010',
                'nama_produk' => 'Ferrari Flags & Banner',
                'kategori'    => 'Fan Item',
                'stok'        => 30,
                'harga'       => 215000,
                'tanggal_masuk' => '2025-04-18',
                'foto'        => null,
            ],
        ];

        foreach ($data as $item) {
            Merchandise::create($item);
        }
    }
}
