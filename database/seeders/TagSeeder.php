<?php

namespace Database\Seeders;


use App\Modules\Common\Url\Models\Url;

class TagSeeder extends BaseSeeder
{

    public function run()
    {
        $tags[1]  = [
            ['name' => 'счет'],
            ['name' => 'логика'],
            ['name' => 'память'],
            ['name' => 'буквы'],
        ];

        $tags[2]  = [
            ['name' => 'count'],
            ['name' => 'logic'],
            ['name' => 'memory'],
            ['name' => 'letters'],
        ];

        $languages = [1,2];

        $prefix = [
            1 => '/игры/математика/',
            2 => '/games/math/',
        ];

        foreach ($tags[1] as $key => $tag){

            $list[] = [
                'taggable_type' => Url::GAME_CATEGORY
            ];

            $taggables[] = [
                'tag_id' => $key+1,
                'taggable_id' => random_int(1,8),
                'taggable_type' => 'game',
            ];
        }

        $this->service->make('tags', $list);
        $this->service->make('taggables', $taggables, false);


        foreach ($languages as $language){

            $urls = [];
            $translations = [];

            foreach ($tags[$language] as $key => $tag){

                $translations[] = [
                    'tag' => $tag['name'],
                    'title' => $tag['name'],
                    'description' => '-',
                    'seo_title' => $tag['name'],
                    'seo_keywords' => '-',
                    'seo_description' => '-',
                    'seo_url' => $tag['name'],
                    'sort' => $key * 10,
                    'is_active' => 1,
                    'tag_id' => $key+1,
                    'language_id' => $language,
                ];

                $urls[] = [
                    'entity' => Url::TAG,
                    'entity_id' => $key+1,
                    'is_root' => 0,
                    'is_list' => 1,
                    'list' => json_encode([Url::GAME]),
                    'url' => $prefix[$language].$tag['name'],
                    'language_id' => $language
                ];


            }

            $this->service->make('urls', $urls);
            $this->service->make('tag_translations', $translations);

        }

        $tagsCategories = [
            ['tag_id' => 1, 'category_id' => 2],
            ['tag_id' => 2, 'category_id' => 2],
            ['tag_id' => 3, 'category_id' => 3],
            ['tag_id' => 4, 'category_id' => 3],
        ];

        $this->service->make('tags_categories', $tagsCategories, false);
    }
}
