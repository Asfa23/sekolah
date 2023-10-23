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
        Schema::create('pengeluaran_sekolahs', function (Blueprint $table) {
            $table->id('ID_PENGELUARAN');
            $table->decimal('JUMLAH_PENGELUARAN', 20, 2);
            $table->string('KETERANGAN');
            $table->enum('KATEGORI', ['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya']);
            $table->date('TANGGAL_PENGELUARAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_sekolahs');
    }
};
