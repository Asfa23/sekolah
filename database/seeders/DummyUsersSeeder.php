<?php

namespace Database\Seeders;

use App\models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Mas Staff',
                'email'=>'staff@gmail.com',
                'role'=>'staff',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Mas Siswa',
                'email'=>'siswa@gmail.com',
                'role'=>'siswa',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Mas Guru',
                'email'=>'guru@gmail.com',
                'role'=>'guru',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Mas Super Admin',
                'email'=>'superAdmin@gmail.com',
                'role'=>'superAdmin',
                'password'=>bcrypt('123456')
            ]
        ];

        foreach($userData as $key => $val){
            User::create($val); 
        }
    }
}
