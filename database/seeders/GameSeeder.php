<?php

namespace Database\Seeders;


class GameSeeder extends BaseSeeder
{

    public function run()
    {
        $games = [
            ['name' => 'Веселый счет', 'seo_url' => 'happy-count', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Рассели по домикам', 'seo_url' => 'house', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Таблица Шульте', 'seo_url' => 'shulte', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Запомни', 'seo_url' => 'memory', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Найди буквы', 'seo_url' => 'letters', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Расставь по порядку', 'seo_url' => 'order', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Быстрая сортировка', 'seo_url' => 'quick-sort', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Фигуры', 'seo_url' => 'figures', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 1],
            ['name' => 'Найди соседа', 'seo_url' => 'neighbour', 'game' => '/storage/js/games/2/bundle.js', 'category_id' => 2],
        ];

        $languages = [1,2];

        foreach ($games as $key => $game){

            $list[] = [
                'category_id' => $game['category_id'],
                'game' => '/storage/js/games/2/bundle.js',
                'thumb' => '/storage/thumbs/games/2.png'
            ];

            foreach ($languages as $language){

                $translations[] = [
                    'title' => $game['name'],
                    'description' => '-',
                    'seo_title' => $game['name'],
                    'seo_keywords' => '-',
                    'seo_description' => '-',
                    'seo_url' => $game['seo_url'].'-'.$language,
                    'sort' => $key * 10,
                    'is_active' => 1,
                    'game_id' => $key+1,
                    'language_id' => $language,
                ];

                $urls[] = ['entity' => 'game', 'entity_id' => $key+1, 'language_id' => $language , 'url' => '/games/count/'.$game['seo_url'].'-'.$language]
                ;

            }
        }

        $this->service->make('games', $list);
        $this->service->make('game_translations', $translations);
        $this->service->make('urls', $urls);

    }
}
