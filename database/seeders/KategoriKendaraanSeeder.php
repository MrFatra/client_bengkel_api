<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            [
            'nama' => 'Mobil',
            'tipe' => 'mobil',
            'layanan' => [
                [
                'nama' => 'Perbaikan Langsung',
                'deskripsi' => 'Layanan perbaikan langsung untuk kerusakan kendaraan.',
                'spareparts' => [
                    ['Kampas Rem', 'Bendix'],
                    ['Oli Mesin', 'Shell'],
                    ['Aki 70Ah', 'GS Astra'],
                ]
                ],
                [
                'nama' => 'Derek Mobil',
                'deskripsi' => 'Layanan derek mobil untuk kendaraan mogok atau kecelakaan.',
                'spareparts' => []
                ],
                [
                'nama' => 'Perawatan Mobil',
                'deskripsi' => 'Layanan perawatan berkala kendaraan mobil.',
                'spareparts' => [
                    ['Filter Udara', 'Denso'],
                    ['Filter Oli', 'Toyota Genuine'],
                    ['Radiator Coolant', 'Prestone'],
                ]
                ],
                [
                'nama' => 'Cuci Mobil',
                'deskripsi' => 'Layanan cuci mobil luar dan dalam.',
                'spareparts' => []
                ],
            ]
            ],
            [
            'nama' => 'Motor',
            'tipe' => 'motor',
            'layanan' => [
                [
                'nama' => 'Perbaikan Langsung',
                'deskripsi' => 'Layanan perbaikan langsung untuk kerusakan motor.',
                'spareparts' => [
                    ['Kampas Rem Motor', 'Federal'],
                    ['Oli Mesin Motor', 'Yamalube'],
                    ['Busi Motor', 'NGK'],
                ]
                ],
                [
                'nama' => 'Derek Mobil',
                'deskripsi' => 'Layanan derek motor untuk kendaraan mogok atau kecelakaan.',
                'spareparts' => []
                ],
                [
                'nama' => 'Perawatan Mobil',
                'deskripsi' => 'Layanan perawatan berkala kendaraan motor.',
                'spareparts' => [
                    ['Filter Udara Motor', 'AHM'],
                    ['Rantai Motor', 'SSS'],
                    ['Aki Motor', 'GS Astra'],
                ]
                ],
                [
                'nama' => 'Cuci Mobil',
                'deskripsi' => 'Layanan cuci motor luar dan dalam.',
                'spareparts' => []
                ],
            ]
            ],
        ];

        foreach ($kategoriList as $kategori) {
            $kategoriId = DB::table('kategori_kendaraans')->insertGetId([
            'nama_kategori' => $kategori['nama'],
            'tipe' => $kategori['tipe'],
            'gambar' => null,
            'deskripsi' => 'Kategori ' . $kategori['nama'] . ' - kendaraan tipe ' . $kategori['tipe'],
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
            ]);

            foreach ($kategori['layanan'] as $layanan) {
            $layananId = DB::table('layanans')->insertGetId([
                'kategori_kendaraan_id' => $kategoriId,
                'nama_layanan' => $layanan['nama'],
                'deskripsi' => $layanan['deskripsi'],
                'harga' => rand(50000, 350000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($layanan['spareparts'])) {
                foreach ($layanan['spareparts'] as [$nama, $merk]) {
                DB::table('spareparts')->insert([
                    'layanan_id' => $layananId,
                    'nama_sparepart' => $nama,
                    'merk' => $merk,
                    'stok' => rand(5, 30),
                    'harga' => rand(75000, 500000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                }
            }
            }
        }
    }
}
