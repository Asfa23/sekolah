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

        // Generate entries for each month from January 2020 until now
        $startDate = new \DateTime('2020-01-01');
        $endDate = new \DateTime();
        $interval = new \DateInterval('P1M');
        $period = new \DatePeriod($startDate, $interval, $endDate);

        foreach ($period as $date) {
            // Generate 30 random entries for the pembayaran_siswa table for siswa
            for ($i = 0; $i < 30; $i++) {
                $userId = $faker->randomElement($siswaUserIds);

                Pembayaran_Siswa::create([
                    'ID_USER' => $userId,
                    'JUMLAH_PEMBAYARAN' => $faker->randomFloat(2, 500000, 1000000),
                    'KATEGORI' => 'Pembayaran Siswa',
                    'TANGGAL_PEMBAYARAN' => $date->format('Y-m-d'),
                    'BUKTI_PEMBAYARAN' => $faker->imageUrl(),
                    'STATUS' => 1,
                ]);
            }

            // Generate 10 random entries for the pembayaran_siswa table with any category for staff
            for ($i = 0; $i < 10; $i++) {
                $userId = $faker->randomElement($staffUserIds);

                Pembayaran_Siswa::create([
                    'ID_USER' => $userId,
                    'JUMLAH_PEMBAYARAN' => $faker->randomFloat(2, 500000, 5000000),
                    'KATEGORI' => $faker->randomElement(['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']),
                    'TANGGAL_PEMBAYARAN' => $date->format('Y-m-d'),
                    'BUKTI_PEMBAYARAN' => $faker->imageUrl(),
                    'STATUS' => 1,
                ]);
            }
        }
    }
}
