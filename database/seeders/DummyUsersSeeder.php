<?php

namespace Database\Seeders;

use App\models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $roles = ['superAdmin', 'siswa', 'staff', 'guru'];
        $userData = [];

        // Generate 4 users with specific roles
        for ($i = 0; $i < count($roles); $i++) {
            $userData[] = [
                "id" => 1000 + $i + 1,
                'name' => "User " . ucfirst($roles[$i]),
                'email' => strtolower($roles[$i]) . "@example.com",
                'role' => $roles[$i],
                'password' => bcrypt('12345678')
            ];
        }

        // Generate 46 users with real names and roles (excluding superAdmin)
        for ($i = 4; $i < 50; $i++) {
            $userData[] = [
                "id" => 2000 + $i + 1,
                'name' => $faker->name,
                'email' => "user{$i}@example.com",
                'role' => $roles[($i - 1) % (count($roles) - 1) + 1], // Exclude superAdmin
                'password' => bcrypt('12345678')
            ];
        }

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
