<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran_Siswa extends Model
{
    protected $primaryKey = 'ID_PEMBAYARAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_SISWA',
        'JUMLAH_PEMBAYARAN',
        'TANGGAL_PEMBAYARAN',
        'KATEGORI'
    ];
    protected $table = 'pembayaran_siswa';
}
