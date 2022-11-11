<?php

namespace Database\Seeders;


use App\Modules\Common\Url\Models\Url;
use Faker\Factory;

class ArticleSeeder extends BaseSeeder
{

    public function run()
    {
        $languages = [1,2];

        $faker[1] = Factory::create('Ru_RU');
        $faker[2] = Factory::create('En_US');
        $articles = [];

        foreach ($languages as $language){
            for($i = 0; $i < 40; $i++){
                $articles[$language][] = ["title" => str_ireplace('.','',($faker[$language]->unique()->text(25)))];
                $list[] = [
                    'category_id' => random_int(1,3),
                    'thumb' => ''
                ];
            }
        }

        $prefix = [
            1 => '/блог/',
            2 => '/blog/',
        ];


        foreach ($languages as $language){

            foreach ($articles[$language] as $key => $article){

                $translations[] = [
                        'title' => $article['title'],
                        'description' => $faker[$language]->text(),
                        'content' => $faker[$language]->text(600),
                        'seo_title' => $article['title'],
                        'seo_keywords' => '-',
                        'seo_description' => '-',
                        'seo_url' => str_ireplace(' ','-',(strtolower($article['title']))),
                        'sort' => $key * 10,
                        'is_active' => 1,
                        'article_id' => $key+1,
                        'language_id' => $language,
                    ];

                    $urls[] = [
                        'entity' => Url::ARTICLE,
                        'entity_id' => $key+1,
                        'language_id' => $language ,
                        'url' => $prefix[$language].str_ireplace(' ','-',(strtolower($article['title'])))
                    ];

                }
            }

        $this->service->make('articles', $list);
        $this->service->make('article_translations', $translations);
        $this->service->make('urls', $urls);

    }
}
