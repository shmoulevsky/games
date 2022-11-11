<?php

namespace Database\Seeders;


class GameCategorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories[1] = [
            ["url" => "игры", "title" => "Игры"],
            ["url" => "математика", "title" => "Математика"],
            ["url" => "геометрия", "title" => "Геометрия"],
            ["url" => "буквы", "title" => "Буквы"],
            ["url" => "логика", "title" => "Логика"],
            ["url" => "мышление", "title" => "Мышление"],
            ["url" => "память", "title" => "Память"]
        ];

        $categories[2] = [
            ["url" => "games", "title" => "Games"],
            ["url" => "math", "title" => "Math"],
            ["url" => "geom", "title" => "Geometry"],
            ["url" => "letters", "title" => "Letters"],
            ["url" => "logic", "title" => "Logic"],
            ["url" => "mind", "title" => "Mind"],
            ["url" => "memory", "title" => "Memory"]
        ];

        $languages = [1,2];

        $prefix = [
            1 => '/игры/',
            2 => '/games/',
        ];
        foreach ($languages as $language) {
            foreach ($categories[$language] as $key => $category) {

                $list[] = [
                    '_lft' => 0,
                    '_rgt' => 0,
                ];

                $translations[] = [
                    'title' => $category['title'],
                    'description' => '-',
                    'seo_title' => $category['title'],
                    'seo_keywords' => '-',
                    'seo_description' => '-',
                    'seo_url' => $category['url'],
                    'sort' => $key * 10,
                    'is_active' => 1,
                    'game_category_id' => $key+1,
                    'language_id' => $language,
                ];

                if($key === 0) continue;

                $urls[] = [
                    'entity' => 'game_category',
                    'entity_id' => $key+1,
                    'language_id' => $language ,
                    'is_root' => 0,
                    'is_list' => 1,
                    'list' => json_encode(['game']),
                    'url' => $prefix[$language].$category['url']
                ];

            }
        }

        $this->service->make('game_categories', $list);
        $this->service->make('game_category_translations', $translations);
        $this->service->make('urls', $urls);


    }
}
