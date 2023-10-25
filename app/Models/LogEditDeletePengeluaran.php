<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEditDeletePengeluaran extends Model
{
    protected $table = 'log_edit_delete_pengeluaran'; // Nama tabel yang sesuai

    protected $primaryKey = 'ID_LOG'; // Nama kolom sebagai primary key

    // Definisikan kolom-kolom lain yang dapat diisi
    protected $fillable = [
        'ID_USER',
        'JUMLAH_UANG',
        'KATEGORI',
        'TANGGAL_PENGUBAHAN',
        'AKSI',
        'ALASAN',
    ];

    // Timestamps (optional)
    public $timestamps = false; // Jika tidak menggunakan kolom 'created_at' dan 'updated_at'
}
