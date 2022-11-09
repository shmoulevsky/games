<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Eugeny',
                'lastname' => 'Shmoulevskiy',
                'email' => 'shmoulevskiye@gmail.com',
                'phone' => '+792312345678',
                'group_id' => 1,
                'access_panel' => 1,
                'password' => "123123",
                'country_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Ivan',
                'lastname' => 'Ivanov',
                'email' => 'ivanov@mail.ru',
                'phone' => '+795012345670',
                'group_id' => 2,
                'access_panel' => 0,
                'password' => "123123",
                'country_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Petr',
                'lastname' => 'Petrov',
                'email' => 'petrov@mail.ru',
                'phone' => '+791315645671',
                'group_id' => 2,
                'access_panel' => 0,
                'password' => "123123",
                'country_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ]
        ];

        foreach ($users as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'group_id' => $user['group_id'],
                'access_panel' => $user['access_panel'],
                'country_id' => $user['country_id'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
