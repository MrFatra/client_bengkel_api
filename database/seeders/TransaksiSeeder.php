<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = Transaksi::create([
            'users_id'    => 2,
            'layanan_id'  => 1,
            'tanggal'     => now(),
            'total_bayar' => 100000,
            'no_polisi'   => 'B1234XYZ',
            'latitude'    => -6.20000000,
            'longitude'   => 106.81666600,
            'alamat'      => 'Jl. Contoh Alamat No. 1, Jakarta',
            'status'      => 'pending',
        ]);

        // Insert related detail_spareparts
        DB::table('detail_spareparts')->insert([
            'transaksi_id' => $transaksi->id,
            'sparepart_id' => 1,
            'jumlah'       => 2,
            'harga_satuan' => 25000,
            'subtotal'     => 50000,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
