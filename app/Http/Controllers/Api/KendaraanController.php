<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriKendaraan;
use App\Models\Layanan;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = KategoriKendaraan::where('status', 'aktif')->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data kendaraan yang ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data kendaraan berhasil diambil',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kendaraan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showLayanan($id)
    {
        try {
            $kategoriKendaraan = KategoriKendaraan::with('layanan')->findOrFail($id);

            if ($kategoriKendaraan->layanan->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada layanan yang ditemukan untuk kategori kendaraan ini',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data layanan berhasil diambil',
                'data' => $kategoriKendaraan->layanan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data layanan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showSparepart($id)
    {
        try {
            $kategoriKendaraan = Sparepart::where('layanan_id', $id)
                ->with('kategoriKendaraan')
                ->get();

            if ($kategoriKendaraan->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada sparepart yang ditemukan untuk kategori kendaraan ini',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data sparepart berhasil diambil',
                'data' => $kategoriKendaraan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sparepart',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
