<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactPemasukan extends Model
{
    protected $table = 'fact_pemasukan';
    protected $primaryKey = 'id_pemasukan';
    public $timestamps = false;

    protected $fillable = [
        'ID_USER',
        'ID_PEMBAYARAN',
        'KATEGORI',
        'TANGGAL_PEMBAYARAN',
        'JUMLAH_PEMBAYARAN',
        'BUKTI_PEMBAYARAN',
        'id_waktu',
    ];
}
