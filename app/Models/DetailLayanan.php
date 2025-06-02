<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLayanan extends Model
{
    protected $table = 'detail_layanans';

    protected $guarded = [];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
