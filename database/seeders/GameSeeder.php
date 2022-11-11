<?php

namespace Database\Seeders;


use App\Modules\Common\Url\Models\Url;

class GameSeeder extends BaseSeeder
{

    public function run()
    {

        $games[1] = [
            ["title" => "Веселый счет"],
            ["title" => "Рассели по домикам"],
            ["title" => "Таблица Шульте"],
            ["title" => "Запомни"],
            ["title" => "Найди буквы"],
            ["title" => "Расставь по порядку"],
            ["title" => "Быстрая сортировка"],
            ["title" => "Фигуры"],
            ["title" => "Найди соседа"],
        ];

        $games[2] = [
            ["title" => "Happy count"],
            ["title" => "Houses"],
            ["title" => "Shulte"],
            ["title" => "Remember"],
            ["title" => "Find letters"],
            ["title" => "Make order"],
            ["title" => "Quick sort"],
            ["title" => "Figures"],
            ["title" => "Find neighbour"],
        ];


        $prefix = [
            1 => '/игры/',
            2 => '/games/',
        ];

        $languages = [1,2];

        foreach ($games[1] as $key => $game) {

            $list[] = [
                'category_id' => random_int(2,3),
                'game' => '/storage/js/games/2/bundle.js',
                'thumb' => '/storage/thumbs/games/2.png'
            ];
        }

        foreach ($languages as $language){

            foreach ($games[$language] as $key => $game){

                $translations[] = [
                        'title' => $game['title'],
                        'description' => '-',
                        'seo_title' => $game['title'],
                        'seo_keywords' => '-',
                        'seo_description' => '-',
                        'seo_url' => str_ireplace(' ','-',(strtolower($game['title']))),
                        'sort' => $key * 10,
                        'is_active' => 1,
                        'game_id' => $key+1,
                        'language_id' => $language,
                    ];

                    $urls[] = [
                        'entity' => Url::GAME,
                        'entity_id' => $key+1,
                        'language_id' => $language ,
                        'url' => $prefix[$language].str_ireplace(' ','-',(strtolower($game['title'])))
                    ];

                }
            }

        $this->service->make('games', $list);
        $this->service->make('game_translations', $translations);
        $this->service->make('urls', $urls);

    }
}
