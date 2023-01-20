<?php

namespace App\Modules\Common\Base\Factories;

use App\Modules\Admin\Article\Models\ArticleCategoryTranslation;
use App\Modules\Admin\Article\Models\ArticleTranslation;
use App\Modules\Admin\Game\Models\GameCategoryTranslation;
use App\Modules\Admin\Game\Models\GameTranslation;
use App\Modules\Admin\Page\Models\PageCategoryTranslation;
use App\Modules\Admin\Page\Models\PageTranslation;
use App\Modules\Admin\Tag\Models\TagTranslation;
use App\Modules\Common\Url\Models\Url;

class ModelTranslationFactory
{
    public static function make(string $type)
    {
        $model = null;

        switch ($type){
            case Url::GAME : $model = app()->make(GameTranslation::class); $model->point_column = 'game_id'; break;
            case Url::GAME_CATEGORY : $model = app()->make(GameCategoryTranslation::class); $model->point_column = 'game_category_id'; break;
            case Url::ARTICLE : $model = app()->make(ArticleTranslation::class); $model->point_column = 'article_id'; break;
            case Url::ARTICLE_CATEGORY : $model = app()->make(ArticleCategoryTranslation::class); $model->point_column = 'article_category_id'; break;
            case Url::PAGE : $model = app()->make(PageTranslation::class); $model->point_column = 'page_id'; break;
            case Url::PAGE_CATEGORY : $model = app()->make(PageCategoryTranslation::class);$model->point_column = 'page_category_id'; break;
            case Url::TAG : $model = app()->make(TagTranslation::class); $model->point_column = 'tag_id'; break;
        }

        return $model;
    }
}
