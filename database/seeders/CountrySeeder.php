<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CountrySeeder extends BaseSeeder
{

    public function run()
    {
        $items = [
            [
                'domain' => 'games.ru',
                'name' => 'Russia',
                'iso' => 'ru',
                'sort' => 10,
                'is_active' => 1,
                'default_language' => 1,
                'info' => null,
            ],
            [
                'domain' => 'games.com',
                'name' => 'USA',
                'iso' => 'ru',
                'sort' => 20,
                'is_active' => 1,
                'default_language' => 2,
                'info' => null,
            ],
        ];

        $this->service->make('countries', $items);

    }
}
