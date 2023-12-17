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

        // Get the IDs of staff and superAdmin users
        $staffUserIds = User::where('role', 'staff')->pluck('id')->toArray();
        $superAdminUserIds = User::where('role', 'superAdmin')->pluck('id')->toArray();

        // Generate 50 random entries for the pengeluaran_sekolahs table
        for ($i = 0; $i < 50; $i++) {
            $userId = $faker->randomElement(array_merge($staffUserIds, $superAdminUserIds));

            pengeluaran_sekolah::create([
                'ID_USER' => $userId,
                'JUMLAH_PENGELUARAN' => $faker->randomFloat(2, 100, 10000),
                'KETERANGAN' => $faker->sentence,
                'KATEGORI' => $faker->randomElement(['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya']),
                'BUKTI_PENGELUARAN' => $faker->imageUrl(), // Example of a random image URL
                'TANGGAL_PENGELUARAN' => $faker->date,
            ]);
        }
    }
}
