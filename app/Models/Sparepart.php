<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';

    protected $guarded = [];

    public function kategoriKendaraan()
    {
        return $this->belongsTo(KategoriKendaraan::class, 'kategori_kendaraan_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
