<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\Common\Settings\Models\Settings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            CountrySeeder::class,
            UserGroupSeeder::class,
            UserSeeder::class,
            GameCategorySeeder::class,
            GameSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
