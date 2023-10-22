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
                "id"=> 1010,
                'name'=>'Mas Siswa 1',
                'email'=>'siswa1@gmail.com',
                'role'=>'siswa',
                'password'=>bcrypt('123456')
            ],
            [
                "id"=> 1012,
                'name'=>'Mas Siswa 2',
                'email'=>'siswa2@gmail.com',
                'role'=>'siswa',
                'password'=>bcrypt('123456')
            ],
            [
                "id"=> 1013,
                'name'=>'Mas Siswa 3',
                'email'=>'siswa3@gmail.com',
                'role'=>'siswa',
                'password'=>bcrypt('123456')
            ],
            [
                "id"=> 2001,
                'name'=>'Mas Super Admin',
                'email'=>'superAdmin@gmail.com',
                'role'=>'superAdmin',
                'password'=>bcrypt('123456')
            ],
            [
                "id" => 3001,
                'name'=>'Mas Staff',
                'email'=>'staff@gmail.com',
                'role'=>'staff',
                'password'=>bcrypt('123456')
            ],
            [
                "id" => 4001,
                'name'=>'Mas Guru',
                'email'=>'guru@gmail.com',
                'role'=>'guru',
                'password'=>bcrypt('123456')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val); 
        }
    }
}
