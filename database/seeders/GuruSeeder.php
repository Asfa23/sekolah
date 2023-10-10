<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gurus')->insert([
            ['ID_GURU' => '2001', 'NAMA_GURU' => 'Caca', 'ALAMAT' =>'desa baru', 'NO_TELP' =>'081234567890'],
            ['ID_GURU' => '2002', 'NAMA_GURU' => 'Caci', 'ALAMAT' =>'desa lama', 'NO_TELP' =>'081234567891'],
            ['ID_GURU' => '2003', 'NAMA_GURU' => 'Cacu', 'ALAMAT' =>'desa tertinggal', 'NO_TELP' =>'081234567892'],
        ]);
    }
}
