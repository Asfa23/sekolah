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
        'KATEGORI', // Perbaiki penamaan kolom menjadi 'KATEGORI'
        'KETERANGAN',
        'TANGGAL_PENGELUARAN', // Pastikan penamaan kolom ini sesuai dengan yang ada di tabel
    ];
    protected $table = 'pengeluaran_sekolahs';
    
}


