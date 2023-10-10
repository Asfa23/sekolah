<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswas')->insert([
            ['ID_SISWA' => '1001', 'NAMA_SISWA' => 'Asfa', 'KELAS' => '7A', 'ALAMAT' =>'jawa timur indah', 'NO_TELP' =>'08123456789'],
            ['ID_SISWA' => '1002', 'NAMA_SISWA' => 'Jono', 'KELAS' => '8A', 'ALAMAT' =>'jawa tengah indah', 'NO_TELP' =>'08123456788'],
            ['ID_SISWA' => '1003', 'NAMA_SISWA' => 'Joni', 'KELAS' => '9A', 'ALAMAT' =>'jawa barat indah', 'NO_TELP' =>'08123456787'],
        ]);
    }
}
