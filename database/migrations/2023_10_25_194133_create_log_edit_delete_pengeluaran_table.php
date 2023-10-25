php artisan make:migration log_edit_delete_pengeluaran

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogEditDeletePengeluaranTable extends Migration
{
    public function up()
    {
        Schema::create('log_edit_delete_pengeluaran', function (Blueprint $table) {
            $table->id('ID_LOG');
            $table->unsignedBigInteger('ID_USER');
            $table->decimal('JUMLAH_UANG', 20, 2);
            $table->enum('KATEGORI', ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya', 'Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya']);
            $table->date('TANGGAL_PENGUBAHAN');
            $table->enum('AKSI',['DELETE','EDIT']);
            $table->string('ALASAN');
            // $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_edit_delete_pengeluaran');
    }
}
