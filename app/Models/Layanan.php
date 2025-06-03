<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';

    protected $guarded = [];

    public function kategoriKendaraan()
    {
        return $this->belongsTo(KategoriKendaraan::class, 'kategori_kendaraan_id');
    }

    public function spareparts()
    {
        return $this->hasMany(Sparepart::class, 'layanan_id');
    }
}
