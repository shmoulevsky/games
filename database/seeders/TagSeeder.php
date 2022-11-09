<?php

namespace Database\Seeders;


class TagSeeder extends BaseSeeder
{

    public function run()
    {
        $tags  = [
            ['name' => 'счет', 'seo_url' => 'figurs'],
            ['name' => 'логика', 'seo_url' => 'logik'],
            ['name' => 'память', 'seo_url' => 'memory'],
            ['name' => 'буквы', 'seo_url' => 'letters'],
        ];

        $languages = [1,2];

        foreach ($tags as $key => $tag){

            foreach ($languages as $language){

                $list[] = [
                    'tag' => $tag['name'],
                    'sort' => $key*10,
                    'is_active' => 1,
                    'language_id' => $language
            ];

            }
        }

        $this->service->make('tags', $list);
    }
}
