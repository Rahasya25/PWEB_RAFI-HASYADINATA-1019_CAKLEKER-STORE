<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 50)->unique();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->integer('stok_produk')->default(0);
            $table->integer('harga_produk');
            $table->date('tanggal_masuk');
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });
    }

};
