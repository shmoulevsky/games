<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    protected SeederService $service;

    public function __construct(SeederService $service)
    {
        $this->service = $service;
    }
}
