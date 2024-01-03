<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactTransaksi extends Model
{
    protected $table = 'fact_transaksi';

    protected $fillable = [
        'id_pemasukan',
        'ID_USER',
        'ID_PEMBAYARAN',
        'KATEGORI',
        'TANGGAL_PEMBAYARAN',
        'JUMLAH_PEMBAYARAN',
        'BUKTI_PEMBAYARAN',
        'ID_PENGELUARAN',
        'ID_USER_1',
        'KATEGORI_1',
        'TANGGAL_PENGELUARAN',
        'JUMLAH_PENGELUARAN',
        'KETERANGAN',
        'BUKTI_PENGELUARAN',
    ];
}
