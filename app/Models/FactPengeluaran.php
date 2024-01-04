<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactPengeluaran extends Model
{
    protected $table = 'fact_pengeluaran';
    protected $primaryKey = 'ID_PENGELUARAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_USER',
        'KATEGORI',
        'TANGGAL_PENGELUARAN',
        'JUMLAH_PENGELUARAN',
        'KETERANGAN',
        'BUKTI_PENGELUARAN',
        'id_waktu',
    ];
}
