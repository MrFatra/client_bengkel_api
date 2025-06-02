<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKendaraan extends Model
{
    protected $table = 'kategori_kendaraans';

    protected $guarded = [];


    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'kategori_kendaraan_id');
    }

    public function spareparts()
    {
        return $this->hasMany(Sparepart::class, 'kategori_kendaraan_id');
    }
}
