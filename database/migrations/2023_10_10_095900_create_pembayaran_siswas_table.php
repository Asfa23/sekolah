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
        Schema::create('pembayaran_siswa', function (Blueprint $table) {
            $table->id('ID_PEMBAYARAN');
            $table->unsignedBigInteger('ID_USER');
            $table->decimal('JUMLAH_PEMBAYARAN', 20, 2);
            $table->enum('KATEGORI', ['Pembayaran Siswa','Bantuan Pemerintah','Pemasukan Lainnya']);
            $table->date('TANGGAL_PEMBAYARAN');
            $table->text('BUKTI_PEMBAYARAN')->nullable();
            $table->tinyInteger('STATUS')->default(0);

            $table->foreign('ID_USER')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_siswa');
    }
};
