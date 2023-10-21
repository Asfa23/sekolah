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
        Schema::create('total_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('KATEGORI');
            $table->decimal('TOTAL_PERKATEGORI', 20, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_pengeluaran');
    }
};
