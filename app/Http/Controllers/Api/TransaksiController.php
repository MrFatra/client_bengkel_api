<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'total_bayar' => 'required|integer|min:0',
            'no_polisi' => 'nullable|string|max:15',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,proses,selesai',
            'layanans' => 'nullable|array',
            'layanans.*.layanan_id' => 'required_with:layanans|exists:layanans,id',
            'layanans.*.harga' => 'required_with:layanans|integer|min:0',
            'spareparts' => 'nullable|array',
            'spareparts.*.sparepart_id' => 'required_with:spareparts|exists:spareparts,id',
            'spareparts.*.jumlah' => 'required_with:spareparts|integer|min:1',
            'spareparts.*.harga_satuan' => 'required_with:spareparts|integer|min:0',
            'spareparts.*.subtotal' => 'required_with:spareparts|integer|min:0',
        ]);
        try {

            // Simpan transaksi
            $transaksi = \App\Models\Transaksi::create([
                'users_id' => $request->user()->id, // Ambil ID user dari token autentikasi
                'tanggal' => $validatedData['tanggal'],
                'total_bayar' => $validatedData['total_bayar'],
                'no_polisi' => $validatedData['no_polisi'] ?? null,
                'latitude' => $validatedData['latitude'] ?? null,
                'longitude' => $validatedData['longitude'] ?? null,
                'alamat' => $validatedData['alamat'] ?? null,
                'status' => $validatedData['status'] ?? 'pending',
            ]);

            // Simpan detail layanan jika ada
            if (!empty($validatedData['layanans'])) {
                foreach ($validatedData['layanans'] as $layanan) {
                    \App\Models\DetailLayanan::create([
                        'transaksi_id' => $transaksi->id,
                        'layanan_id' => $layanan['layanan_id'],
                        'harga' => $layanan['harga'],
                    ]);
                }
            }

            // Simpan detail sparepart jika ada
            if (!empty($validatedData['spareparts'])) {
                foreach ($validatedData['spareparts'] as $sparepart) {
                    $forStock =\App\Models\DetailSparepart::create([
                        'transaksi_id' => $transaksi->id,
                        'sparepart_id' => $sparepart['sparepart_id'],
                        'jumlah' => $sparepart['jumlah'],
                        'harga_satuan' => $sparepart['harga_satuan'],
                        'subtotal' => $sparepart['subtotal'],
                    ]);

                    // Update stok sparepart
                    $sparepartModel = \App\Models\Sparepart::find($sparepart['sparepart_id']);
                    if ($sparepartModel) {
                        $sparepartModel->stok -= $sparepart['jumlah'];
                        $sparepartModel->save();
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Sparepart tidak ditemukan',
                        ], 404);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'data' => $transaksi
            ], 201);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat transaksi',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
