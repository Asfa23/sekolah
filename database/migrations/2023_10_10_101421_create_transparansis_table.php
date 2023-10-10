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
        Schema::create('transparansi', function (Blueprint $table) {
            $table->id('ID_TRANSPARANSI');
            $table->decimal('JUMLAH_PEMBAYARAN')->nullable();
            $table->decimal('JUMLAH_PENGELUARAN')->nullable();
            $table->enum('KATEGORI', ['Pembayaran Siswa', 'Pengadaan Inventaris', 'Maintenance Gedung', 'Gaji Guru dan Staff', 'Program sekolah', 'Lainnya']);
            $table->string('KETERANGAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparansis');
    }
};
