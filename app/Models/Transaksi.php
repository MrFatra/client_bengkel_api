<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $guarded = [];

    public function detailLayanans()
    {
        return $this->hasMany(DetailLayanan::class, 'transaksi_id');
    }

    public function detailSpareparts()
    {
        return $this->hasMany(DetailSparepart::class, 'transaksi_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
