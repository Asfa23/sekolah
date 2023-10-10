<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staffs')->insert([
            ['ID_STAFF' => '3001', 'NAMA_STAFF' => 'Anto', 'ALAMAT' =>'kota baru', 'NO_TELP' =>'08123455555'],
            ['ID_STAFF' => '3002', 'NAMA_STAFF' => 'Anti', 'ALAMAT' =>'kota lama', 'NO_TELP' =>'08123433333'],
            ['ID_STAFF' => '3003', 'NAMA_STAFF' => 'Antu', 'ALAMAT' =>'kota setengah lama', 'NO_TELP' =>'08123444444'],
        ]);
    }
}
