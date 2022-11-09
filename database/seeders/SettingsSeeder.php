<?php

namespace Database\Seeders;


class SettingsSeeder extends BaseSeeder
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
                'key' => 'top_menu',
                'value' => '',
                'group' => 'common',
                'json' => json_encode([
                    1 => [
                        ["url" => "/", "title" => "Главная"],
                        ["url" => "/игры", "title" => "Игры"],
                        ["url" => "/блог", "title" => "Блог"],
                        ["url" => "/о-нас", "title" => "О нас"]
                    ],
                    2 => [
                        ["url" => "/", "title" => "Home"],
                        ["url" => "/games", "title" => "Games"],
                        ["url" => "/blog", "title" => "Blog"],
                        ["url" => "/about", "title" => "About"]
                    ],
                ]),
            ],
            [
                'key' => 'side_menu',
                'value' => '',
                'group' => 'common',
                'json' => json_encode([
                    1 => [
                        ["url" => "/игры/математика", "title" => "Математика"],
                        ["url" => "/игры/геометрия", "title" => "Геометрия"],
                        ["url" => "/игры/буквы", "title" => "Буквы"],
                        ["url" => "/игры/логика", "title" => "Логика"],
                        ["url" => "/игры/мышление", "title" => "Мышление"],
                        ["url" => "/игры/память", "title" => "Память"]
                    ],
                    2 => [
                        ["url" => "/games/math", "title" => "Math"],
                        ["url" => "/games/geom", "title" => "Geometry"],
                        ["url" => "/games/letters", "title" => "Letters"],
                        ["url" => "/games/logic", "title" => "Logic"],
                        ["url" => "/games/mind", "title" => "Mind"],
                        ["url" => "/games/memory", "title" => "Memory"]
                    ],
                ]),
            ],

        ];

        $this->service->make('settings', $items, false);
    }
}
