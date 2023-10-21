<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_sekolah extends Model
{
    protected $primaryKey = 'ID_PENGELUARAN';
    public $timestamps = false;

    protected $fillable = [
        'JUMLAH_PENGELUARAN',
        'KATEGORI',
        'KETERANGAN',
        'TANGGAL_PEMBAYARAN',
    ];
}
