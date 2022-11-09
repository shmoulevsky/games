<?php

namespace Database\Seeders;


class UserGroupSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'User',
            ],
        ];

        $this->service->make('user_groups', $items, false);
    }
}
