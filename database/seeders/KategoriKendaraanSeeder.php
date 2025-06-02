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
                'nama' => 'Motor Matic',
                'tipe' => 'motor',
                'layanan' => [
                    ['Ganti Oli Mesin', 'Mengganti oli mesin motor matic'],
                    ['Servis CVT', 'Pembersihan dan pengecekan bagian CVT'],
                    ['Ganti Kampas Rem', 'Mengganti kampas rem depan dan belakang'],
                    ['Servis Rutin', 'Pengecekan menyeluruh dan penyetelan ringan'],
                    ['Ganti Busi', 'Mengganti busi motor'],
                    ['Ganti Aki', 'Mengganti aki kering motor matic'],
                    ['Cuci Motor', 'Cuci bodi luar motor'],
                ],
                'spareparts' => [
                    ['Oli Yamalube Matic', 'Yamalube'],
                    ['Busi NGK CPR8EA-9', 'NGK'],
                    ['Aki GS GM5Z-3B', 'GS Astra'],
                    ['Kampas Rem Depan', 'Federal'],
                    ['CVT Belt Vario 125', 'Honda'],
                    ['Filter Udara', 'AHM'],
                    ['Lampu LED Depan', 'Osram'],
                ]
            ],
            [
                'nama' => 'Motor Sport',
                'tipe' => 'motor',
                'layanan' => [
                    ['Ganti Oli Racing', 'Mengganti oli mesin motor sport'],
                    ['Setel Kopling', 'Penyetelan kopling motor manual'],
                    ['Servis Karburator', 'Membersihkan dan menyetel karburator'],
                    ['Ganti Rantai', 'Mengganti rantai motor sport'],
                    ['Tune Up Mesin', 'Penyetelan performa mesin'],
                    ['Ganti Kampas Kopling', 'Mengganti kampas kopling manual'],
                    ['Balancing Ban', 'Menyeimbangkan roda motor'],
                ],
                'spareparts' => [
                    ['Oli Motul 5100', 'Motul'],
                    ['Rantai SSS Gold', 'SSS'],
                    ['Kampas Kopling Racing', 'FCC'],
                    ['Busi Iridium NGK', 'NGK'],
                    ['Aki Yuasa YTZ', 'Yuasa'],
                    ['Lampu HID 6000K', 'Philips'],
                    ['Filter Racing', 'K&N'],
                ]
            ],
            [
                'nama' => 'Mobil Sedan',
                'tipe' => 'mobil',
                'layanan' => [
                    ['Ganti Oli Mesin', 'Mengganti oli mesin mobil'],
                    ['Spooring & Balancing', 'Menyeimbangkan dan menyetel arah roda'],
                    ['Ganti Kampas Rem', 'Mengganti kampas rem cakram'],
                    ['Flushing Radiator', 'Membersihkan sistem pendingin radiator'],
                    ['Servis AC', 'Perawatan dan pengisian freon AC'],
                    ['Ganti Filter Kabin', 'Mengganti filter udara kabin'],
                    ['Tune Up Mesin', 'Penyetelan performa mobil'],
                ],
                'spareparts' => [
                    ['Oli Shell Helix HX7', 'Shell'],
                    ['Filter Udara', 'Denso'],
                    ['Kampas Rem Bendix', 'Bendix'],
                    ['Radiator Coolant Prestone', 'Prestone'],
                    ['Aki NS40Z', 'GS Astra'],
                    ['Filter Kabin AC', 'Denso'],
                    ['Lampu H4 LED', 'Osram'],
                ]
            ],
            [
                'nama' => 'Mobil SUV',
                'tipe' => 'mobil',
                'layanan' => [
                    ['Ganti Oli Gardan', 'Mengganti oli gardan mobil SUV'],
                    ['Servis Rem ABS', 'Perawatan sistem rem ABS'],
                    ['Ganti Ban 4WD', 'Penggantian ban khusus SUV'],
                    ['Flushing Transmisi Matic', 'Membersihkan sistem transmisi'],
                    ['Ganti Oli Mesin', 'Ganti oli mesin untuk SUV'],
                    ['Servis AC', 'Servis sistem pendingin kabin'],
                    ['Spooring Roda Belakang', 'Penyetelan roda belakang'],
                ],
                'spareparts' => [
                    ['Oli Gardan SAE 90', 'Pertamina'],
                    ['Ban Bridgestone Dueler', 'Bridgestone'],
                    ['Filter Oli', 'Toyota Genuine'],
                    ['Kampas Rem Belakang', 'Nissin'],
                    ['Freon R134A', 'Denso'],
                    ['Aki 70Ah', 'Incoe'],
                    ['Wiper Blade SUV', 'Bosch'],
                ]
            ],
            [
                'nama' => 'Mobil MPV',
                'tipe' => 'mobil',
                'layanan' => [
                    ['Servis Rutin 10.000 km', 'Pemeriksaan umum mobil'],
                    ['Ganti Oli Mesin', 'Penggantian oli mesin'],
                    ['Cuci Mobil Lengkap', 'Cuci luar dan dalam mobil'],
                    ['Ganti Filter Bensin', 'Mengganti filter bahan bakar'],
                    ['Ganti Kampas Rem', 'Penggantian kampas rem depan'],
                    ['Servis Injektor', 'Pembersihan dan penyetelan injektor'],
                    ['Ganti Busi', 'Penggantian busi mobil'],
                ],
                'spareparts' => [
                    ['Filter Bensin', 'Mitsubishi'],
                    ['Busi Mobil', 'NGK'],
                    ['Kampas Rem Mobil', 'Bendix'],
                    ['Aki MF 60Ah', 'GS Astra'],
                    ['Filter Udara', 'Toyota'],
                    ['Lampu Sein', 'Philips'],
                ]
            ],
            [
                'nama' => 'Truk',
                'tipe' => 'mobil',
                'layanan' => [
                    ['Ganti Oli Diesel', 'Penggantian oli mesin diesel'],
                    ['Overhaul Mesin', 'Perbaikan total mesin'],
                    ['Ganti Kampas Rem', 'Penggantian kampas rem truk'],
                    ['Servis Transmisi', 'Servis transmisi manual'],
                    ['Servis Power Steering', 'Pengecekan sistem kemudi'],
                    ['Ganti Fan Belt', 'Penggantian sabuk kipas'],
                    ['Pengecekan Sistem Kelistrikan', 'Deteksi kerusakan kelistrikan'],
                ],
                'spareparts' => [
                    ['Fan Belt Truk', 'Mitsuboshi'],
                    ['Kampas Rem Truk', 'Ferrodo'],
                    ['Busi Diesel Glow Plug', 'Bosch'],
                    ['Filter Solar', 'Fleetguard'],
                    ['Radiator Truk', 'Denso'],
                    ['Lampu Rem Belakang', 'Koito'],
                ]
            ],
            [
                'nama' => 'Motor Bebek',
                'tipe' => 'motor',
                'layanan' => [
                    ['Ganti Oli Mesin', 'Penggantian oli mesin bebek'],
                    ['Setel Rantai', 'Penyetelan rantai motor'],
                    ['Ganti Ban', 'Penggantian ban depan/belakang'],
                    ['Tune Up', 'Servis ringan menyeluruh'],
                    ['Servis Karburator', 'Pembersihan karburator'],
                    ['Ganti Kampas Rem', 'Penggantian kampas rem tromol'],
                    ['Ganti Busi', 'Penggantian busi'],
                ],
                'spareparts' => [
                    ['Busi Motor Bebek', 'NGK'],
                    ['Ban Tubeless FDR', 'FDR'],
                    ['Rantai SSS Silver', 'SSS'],
                    ['Filter Udara', 'Federal'],
                    ['Lampu Belakang', 'Stanley'],
                    ['Kampas Rem Tromol', 'Aspira'],
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

            foreach ($kategori['layanan'] as [$nama, $desc]) {
                DB::table('layanans')->insert([
                    'kategori_kendaraan_id' => $kategoriId,
                    'nama_layanan' => $nama,
                    'deskripsi' => $desc,
                    'harga' => rand(50000, 350000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($kategori['spareparts'] as [$nama, $merk]) {
                DB::table('spareparts')->insert([
                    'kategori_kendaraan_id' => $kategoriId,
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
