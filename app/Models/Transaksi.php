<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $guarded = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function detailLayanan()
    {
        return $this->hasMany(Layanan::class, 'transaksi_id');
    }

    public function detailSpareparts()
    {
        return $this->hasMany(DetailSparepart::class, 'transaksi_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
