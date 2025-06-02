<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KendaraanController as ApiKendaraanController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\KendaraanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('kendaraan')->group(function () {
        Route::get('/', [ApiKendaraanController::class, 'index']);
        Route::get('/{id}/layanan', [ApiKendaraanController::class, 'showLayanan'])->name('kendaraan.showLayanan');
        Route::get('/{id}/sparepart', [ApiKendaraanController::class, 'showSparepart'])->name('kendaraan.showSparepart');
    });

    Route::prefix('transaksi')->group(function () {
        Route::post('/', [TransaksiController::class, 'store']);
    });
});
