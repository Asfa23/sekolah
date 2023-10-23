<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalPengeluaran extends Model
{
    protected $fillable = [
        'KATEGORI', 
        'TOTAL_PERKATEGORI'
    ];
    protected $table = 'total_pengeluaran';
}
