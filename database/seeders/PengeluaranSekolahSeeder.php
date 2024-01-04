<?php

namespace Database\Seeders;

use App\models\pengeluaran_sekolah;
use App\models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class PengeluaranSekolahSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $staffUserIds = User::where('role', 'staff')->pluck('id')->toArray();
        $superAdminUserIds = User::where('role', 'superAdmin')->pluck('id')->toArray();

        $startDate = new \DateTime('2020-01-01');
        $endDate = new \DateTime();
        $interval = new \DateInterval('P1M');
        $period = new \DatePeriod($startDate, $interval, $endDate);

        foreach ($period as $date) {
            for ($i = 0; $i < 30; $i++) {
                $userId = $faker->randomElement(array_merge($staffUserIds, $superAdminUserIds));

                pengeluaran_sekolah::create([
                    'ID_USER' => $userId,
                    'JUMLAH_PENGELUARAN' => $faker->randomFloat(2, 500000, 1000000),
                    'KETERANGAN' => $faker->sentence,
                    'KATEGORI' => $faker->randomElement(['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya']),
                    'BUKTI_PENGELUARAN' => $faker->imageUrl(),
                    'TANGGAL_PENGELUARAN' => $date->format('Y-m-d'),
                ]);
            }
        }
    }
}
