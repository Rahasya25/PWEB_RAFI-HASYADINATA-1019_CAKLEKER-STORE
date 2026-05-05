<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori'];
    public function merchandises()
    {
        return $this->belongsToMany(Merchandise::class, 'kategori_merchandise');
    }
}
