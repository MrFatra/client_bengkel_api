<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSparepart extends Model
{
    protected $table = 'detail_spareparts';

    protected $guarded = [];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }
}
