<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran_Siswa extends Model
{
    protected $primaryKey = 'ID_PEMBAYARAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_USER',
        'JUMLAH_PEMBAYARAN',        
        'KATEGORI',
        'TANGGAL_PEMBAYARAN',
        'BUKTI_PEMBAYARAN',
        'STATUS'
    ];
    protected $table = 'pembayaran_siswa';
}
