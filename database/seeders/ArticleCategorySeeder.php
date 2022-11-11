<?php

namespace Database\Seeders;


use App\Modules\Common\Url\Models\Url;

class ArticleCategorySeeder extends BaseSeeder
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
        ];

        $categories[2] = [
            ["url" => "games", "title" => "Games"],
            ["url" => "math", "title" => "Math"],
            ["url" => "geom", "title" => "Geometry"],
        ];

        $languages = [1,2];

        $prefix = [
            1 => '/блог/',
            2 => '/blog/',
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
                    'article_category_id' => $key+1,
                    'language_id' => $language,
                ];

                if($key === 0) continue;

                $urls[] = [
                    'entity' => Url::ARTICLE_CATEGORY,
                    'entity_id' => $key+1,
                    'language_id' => $language ,
                    'is_root' => 0,
                    'is_list' => 1,
                    'list' => json_encode(Url::ARTICLE),
                    'url' => $prefix[$language].$category['url']
                ];

            }
        }

        $this->service->make('article_categories', $list);
        $this->service->make('article_category_translations', $translations);
        $this->service->make('urls', $urls);


    }
}
