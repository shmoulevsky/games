<?php

namespace Database\Seeders;

class LanguageSeeder extends BaseSeeder
{

    public function run()
    {
        $items = [
            [
                'name' => 'Russian',
                'code' => 'ru',
                'sort' => 10,
                'dir' => 'ltr',
                'is_active' => 1,
            ],
            [
                'name' => 'English',
                'code' => 'en',
                'sort' => 20,
                'dir' => 'ltr',
                'is_active' => 1,
            ],
        ];

        $this->service->make('languages', $items, false);
    }
}
