<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->string('tipe', 50);
            $table->string('gambar')->nullable(); // Optional, can be null if no image is provided
            $table->text('deskripsi')->nullable(); // Optional, can be null if no description is provided
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Default status is 'aktif'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kendaraans');
    }
};
