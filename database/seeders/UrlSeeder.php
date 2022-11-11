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
                'is_root' => 1,
                'is_list' => 1,
                'list' => [Url::GAME],
            ],
            [
                'entity' => Url::ARTICLE_CATEGORY,
                'entity_id' => 1,
                'url' => '/блог',
                'is_root' => 1,
                'is_list' => 1,
                'list' => [Url::ARTICLE],
            ],
        ];

        $urls[2]  = [
            [
                'entity' => Url::GAME_CATEGORY,
                'entity_id' => 1,
                'url' => '/games',
                'is_root' => 1,
                'is_list' => 1,
                'list' => [Url::GAME],
            ],
            [
                'entity' => Url::ARTICLE_CATEGORY,
                'entity_id' => 1,
                'url' => '/blog',
                'is_root' => 1,
                'is_list' => 1,
                'list' => [Url::ARTICLE],
            ],
        ];

        $languages = [1,2];

        foreach ($languages as $language){

            foreach ($urls[$language] as $key => $url){

                $list[] = [
                    'entity' => $url['entity'],
                    'entity_id' => $url['entity_id'],
                    'is_root' => $url['is_root'],
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
