<?php

namespace Database\Seeders;

use App\Models\Pembayaran_Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class PembayaranSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        // Get the IDs of siswa and staff users
        $siswaUserIds = User::where('role', 'siswa')->pluck('id')->toArray();
        $staffUserIds = User::where('role', 'staff')->pluck('id')->toArray();

        // Generate 50 random entries for the pembayaran_siswa table
        for ($i = 0; $i < 50; $i++) {
            $userId = $faker->randomElement($siswaUserIds);

            Pembayaran_Siswa::create([
                'ID_USER' => $userId,
                'JUMLAH_PEMBAYARAN' => $faker->randomFloat(2, 50, 1000),
                'KATEGORI' => 'Pembayaran Siswa', // Set the category explicitly for siswa
                'TANGGAL_PEMBAYARAN' => $faker->date,
                'BUKTI_PEMBAYARAN' => $faker->imageUrl(), // Example of a random image URL
                'STATUS' => 1, // Assuming all payments are successful
            ]);

            // Generate 10 random entries for the pembayaran_siswa table with any category for staff
            $userId = $faker->randomElement($staffUserIds);

            Pembayaran_Siswa::create([
                'ID_USER' => $userId,
                'JUMLAH_PEMBAYARAN' => $faker->randomFloat(2, 50, 1000),
                'KATEGORI' => $faker->randomElement(['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']),
                'TANGGAL_PEMBAYARAN' => $faker->date,
                'BUKTI_PEMBAYARAN' => $faker->imageUrl(), // Example of a random image URL
                'STATUS' => 1, // Assuming all payments are successful
            ]);
        }
    }
}
