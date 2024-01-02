<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_pembayaran',
        'kategori',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'id_pengeluaran',
        'id_user_1',
        'kategori_1',
        'tanggal_pengeluaran',
        'jumlah_pengeluaran',
        'keterangan',
        'bukti_pengeluaran',
    ];

    // Definisi relasi jika diperlukan
    protected $table = 'fact_transaksi';
}
