<?php

namespace Database\Seeders;


use App\Modules\Common\Url\Models\Url;

class UrlSeeder extends BaseSeeder
{

    public function run()
    {
        $urls[1]  = [
            [
                'entity' => Url::GAME_CATEGORY,
                'entity_id' => 1,
                'url' => '/игры',
                'is_list' => 1,
                'list' => ['game'],
            ],
        ];

        $urls[2]  = [
            [
                'entity' => Url::GAME_CATEGORY,
                'entity_id' => 1,
                'url' => '/games',
                'is_list' => 1,
                'list' => ['game'],
            ],
        ];

        $languages = [1,2];

        foreach ($languages as $language){

            foreach ($urls[$language] as $key => $url){

                $list[] = [
                    'entity' => $url['entity'],
                    'entity_id' => $url['entity_id'],
                    'is_list' => $url['is_list'],
                    'list' => json_encode($url['list']),
                    'url' => $url['url'],
                    'language_id' => $language
            ];

            }
        }

        $this->service->make('urls', $list);
    }
}
